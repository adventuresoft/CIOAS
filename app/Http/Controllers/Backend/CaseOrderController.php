<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CaseOrder;
use App\Models\MisCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaseOrderController extends Controller
{
    /**
     * All Case Order — সকল CaseOrder রেকর্ড দেখাবে।
     */
    public function index()
    {
        // প্রতিটি mis_case_id-র সর্বশেষ CaseOrder রেকর্ড নিয়ে তালিকা তৈরি
        $caseOrders = CaseOrder::with('misCase')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('case_orders')
                    ->groupBy('mis_case_id');
            })
            ->latest()
            ->paginate(20);

        return view('backend.pages.case-order.index', compact('caseOrders'));
    }

    /**
     * New Case Order — entry না হওয়া MisCase গুলো দেখাবে।
     */
    public function create()
    {
        // যে mis_case_id গুলো ইতিমধ্যে case_orders-এ আছে
        $registeredCaseIds = CaseOrder::pluck('mis_case_id')->unique()->toArray();

        // বাকি সব MisCase গুলো
        $pendingCases = MisCase::whereNotIn('id', $registeredCaseIds)
            ->latest()
            ->paginate(20);

        return view('backend.pages.case-order.create', compact('pendingCases'));
    }

    /**
     * নতুন CaseOrder তৈরি করা (New Case Order পেজ থেকে)।
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mis_case_id'       => 'required|exists:mis_cases,id',
            'next_hearing_date' => 'nullable|date',
            'next_hearing_time' => 'nullable|string',
            'status'            => 'nullable|string',
            'command_type'      => 'nullable|string|max:255',
            'command_text'      => 'nullable|string',
            'command_yes_note'  => 'nullable|string',
            'side_note'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'তথ্য যাচাই ব্যর্থ হয়েছে।',
                    'errors'  => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $misCaseId = $request->input('mis_case_id');
        
        // এই mis_case_id-র সর্বোচ্চ hearing_no বের করা
        $maxHearing = CaseOrder::where('mis_case_id', $misCaseId)->max('hearing_no') ?? 0;

        $caseOrder = new CaseOrder();
        $caseOrder->mis_case_id       = $misCaseId;
        $caseOrder->next_hearing_date = $request->input('next_hearing_date');
        $caseOrder->next_hearing_time = $request->input('next_hearing_time');
        $caseOrder->status            = $request->input('status', '0');
        $caseOrder->command_type      = $request->input('command_type');
        $caseOrder->command_text      = $request->input('command_text');
        $caseOrder->command_yes_note  = $request->input('command_yes_note');
        $caseOrder->side_note         = $request->input('side_note');
        $caseOrder->hearing_no        = $maxHearing + 1;
        $caseOrder->date_changed      = false;
        $caseOrder->order_by          = auth()->id();
        $caseOrder->save();

        // MisCase-এর next_hearing_date আপডেট
        if ($request->input('next_hearing_date')) {
            $this->syncMisCase($misCaseId, $request->input('next_hearing_date'), $request->input('next_hearing_time'));
        }

        if ($request->ajax()) {
            return response()->json([
                'status'  => true,
                'message' => 'Case Order সফলভাবে তৈরি হয়েছে।',
            ], 200);
        }

        return redirect()->route('caseorder.create')->with('success', 'Case Order সফলভাবে তৈরি হয়েছে।');
    }

    /**
     * Case Order Show — একটি কেসের সব ইতিহাস + নতুন order ফর্ম।
     */
    public function show(string $id)
    {
        // $id এখানে mis_case_id
        $misCase    = MisCase::findOrFail($id);
        $caseOrders = CaseOrder::with('creator.department', 'creator.section')
            ->where('mis_case_id', $id)
            ->orderBy('hearing_no', 'desc')
            ->get();

        return view('backend.pages.case-order.show', compact('misCase', 'caseOrders'));
    }

    /**
     * Case Order Registration Form.
     */
    public function register(string $misCaseId)
    {
        $misCase    = MisCase::findOrFail($misCaseId);
        $caseOrders = CaseOrder::with('creator.department', 'creator.section')
            ->where('mis_case_id', $misCaseId)
            ->orderBy('hearing_no', 'desc')
            ->get();

        return view('backend.pages.case-order.register', compact('misCase', 'caseOrders'));
    }

    /**
     * Date/Time Edit ফর্ম।
     */
    public function edit(string $id)
    {
        $caseOrder = CaseOrder::with('misCase')->findOrFail($id);

        return view('backend.pages.case-order.edit', compact('caseOrder'));
    }

    /**
     * Date/Time আপডেট + MisCase sync।
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'next_hearing_date' => 'required|date',
            'next_hearing_time' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'সঠিক তারিখ প্রদান করুন।',
                    'errors'  => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $caseOrder = CaseOrder::findOrFail($id);
        $caseOrder->next_hearing_date = $request->input('next_hearing_date');
        $caseOrder->next_hearing_time = $request->input('next_hearing_time');
        $caseOrder->date_changed      = true;
        $caseOrder->save();

        // MisCase sync
        $this->syncMisCase($caseOrder->mis_case_id, $request->input('next_hearing_date'), $request->input('next_hearing_time'));

        if ($request->ajax()) {
            return response()->json([
                'status'  => true,
                'message' => 'তারিখ সফলভাবে আপডেট হয়েছে।',
            ], 200);
        }

        return redirect()->route('caseorder.dateEditList')->with('success', 'তারিখ সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * CaseOrder মুছে ফেলা।
     */
    public function destroy(string $id)
    {
        $caseOrder = CaseOrder::findOrFail($id);
        $caseOrder->delete();

        if (request()->ajax()) {
            return response()->json([
                'status'  => true,
                'message' => 'Case Order মুছে ফেলা হয়েছে।',
            ], 200);
        }

        return redirect()->route('caseorder.index')->with('success', 'Case Order মুছে ফেলা হয়েছে।');
    }

    /**
     * Case Date Edit List — date_changed=true হওয়া কেসের তালিকা।
     */
    public function dateEditList()
    {
        $caseOrders = CaseOrder::with('misCase')
            ->where('date_changed', true)
            ->latest()
            ->paginate(20);

        return view('backend.pages.case-order.date-edit-list', compact('caseOrders'));
    }

    /**
     * All Case Order পেজ থেকে নতুন Order entry।
     */
    public function addOrder(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'next_hearing_date' => 'nullable|date',
            'next_hearing_time' => 'nullable|string',
            'status'            => 'nullable|string',
            'command_type'      => 'nullable|string|max:255',
            'command_text'      => 'nullable|string',
            'command_yes_note'  => 'nullable|string',
            'side_note'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'তথ্য যাচাই ব্যর্থ হয়েছে।',
                    'errors'  => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        // $id = mis_case_id
        $misCase = MisCase::findOrFail($id);
        $maxHearing = CaseOrder::where('mis_case_id', $id)->max('hearing_no') ?? 0;

        $caseOrder = new CaseOrder();
        $caseOrder->mis_case_id       = $id;
        $caseOrder->next_hearing_date = $request->input('next_hearing_date');
        $caseOrder->next_hearing_time = $request->input('next_hearing_time');
        $caseOrder->status            = $request->input('status', '0');
        $caseOrder->command_type      = $request->input('command_type');
        $caseOrder->command_text      = $request->input('command_text');
        $caseOrder->command_yes_note  = $request->input('command_yes_note');
        $caseOrder->side_note         = $request->input('side_note');
        $caseOrder->hearing_no        = $maxHearing + 1;
        $caseOrder->date_changed      = false;
        $caseOrder->order_by          = auth()->id();
        $caseOrder->save();

        // MisCase sync
        if ($request->input('next_hearing_date')) {
            $this->syncMisCase($id, $request->input('next_hearing_date'), $request->input('next_hearing_time'));
        }

        if ($request->ajax()) {
            return response()->json([
                'status'  => true,
                'message' => 'নতুন Order সফলভাবে যোগ হয়েছে।',
            ], 200);
        }

        return redirect()->route('caseorder.show', $id)->with('success', 'নতুন Order সফলভাবে যোগ হয়েছে।');
    }

    /**
     * Hearing Notice - today and upcoming cases hearing list.
     */
    public function hearingNotice()
    {
        $today = now()->startOfDay()->format('Y-m-d');
        
        $cases = MisCase::with('caseOrders')
            ->where('next_hearing_date', '>=', $today)
            ->orderBy('next_hearing_date', 'asc')
            ->paginate(20);

        return view('backend.pages.case-order.hearing-notice', compact('cases'));
    }

    /**
     * MisCase-এর case_date ও case_time আপডেট করা।
     */
    private function syncMisCase(int $misCaseId, ?string $date, ?string $time): void
    {
        $misCase = MisCase::find($misCaseId);
        if (!$misCase) {
            return;
        }

        if ($date) {
            $misCase->next_hearing_date = $date;
            // case_date ও আপডেট করি
            $misCase->case_date = $date;
        }

        if ($time && \Illuminate\Support\Facades\Schema::hasColumn('mis_cases', 'case_time')) {
            $misCase->case_time = $time;
        }

        $misCase->save();
    }
}
