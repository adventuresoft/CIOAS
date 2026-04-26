<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseOwnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HouseOwnershipController extends Controller
{

    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }


    public function loadOwnershipForm()
    {
        $data['ownership'] = null;
        return view('backend.pages.house.forms.ownership', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'house_id' => 'nullable|max:190',
            'name' => 'nullable|max:190',
            'nid' => 'nullable|max:190',
            'mobile' => 'nullable|max:190',
            'address' => 'nullable|max:190',
            'quantity' => 'nullable|max:190'
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $ids = $request->id;
        $names = $request->name;
        $nids = $request->nid;
        $mobiles = $request->mobile;
        $addresses = $request->address;
        $quantities = $request->quantity;

        if(!empty($names)){
            foreach ($names as $key => $name) {
                if($ids[$key]){
                    $ownership = HouseOwnership::find($ids[$key]);
                }else {
                    $ownership = new HouseOwnership();
                }

                $ownership->house_id  = $request->house_id;
                $ownership->name  = $name;
                $ownership->nid  = $nids[$key];
                $ownership->mobile  = $mobiles[$key];
                $ownership->address  = $addresses[$key];
                $ownership->quantity  = $quantities[$key];
                $ownership->save();
            }

            $data['status'] = true;
            $data['message'] = "House ownership submitted successfully!";
            return response()->json($data, 200);
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseOwnership  $houseOwnership
     * @return \Illuminate\Http\Response
     */
    public function show(HouseOwnership $houseOwnership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseOwnership  $houseOwnership
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $data['house'] = House::with('ownership')->find($id);
        if($data['house']) {
            return view('backend.pages.house.tabs.ownership', $data);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseOwnership  $houseOwnership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseOwnership $houseOwnership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseOwnership  $houseOwnership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ownership = HouseOwnership::find($id);
        if($ownership){
            try {
                $ownership->delete();
                $data['status'] = true;
                $data['message'] = "Ownership deleted successfully";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Nothing found to delete!";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Nothing found to delete!";
            return response()->json($data, 404);
        }
    }
}
