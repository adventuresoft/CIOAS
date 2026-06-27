<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\People;
use App\Models\People\FamilyInfo;
use App\Models\People\AddressInfo;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Pourashava;
use App\Models\CityCorporation;
use App\Models\BasicSettings\Village;
use App\Models\PostOffice;
use App\Models\UnionWard;
use App\Models\License\License;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\PersonGunApplication;
use App\Models\OrgGunApplication;
use App\Models\OtherOrgGunApplication;
use App\Models\Inquiry;
use App\Models\AppointmentBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDashboardController extends Controller
{
    public function registerForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        $divisions = Division::where('status', true)->get();
        return view('frontend.pages.user.register', compact('divisions'));
    }

    public function registerStore(Request $request)
    {
        // Construct date of birth string from inputs
        $dob = sprintf('%04d-%02d-%02d', $request->dob_year, $request->dob_month, $request->dob_day);
        $request->merge(['dob' => $dob]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'bn_name' => 'required|string|max:191',
            'dob_day' => 'required|integer|min:1|max:31',
            'dob_month' => 'required|integer|min:1|max:12',
            'dob_year' => 'required|integer|min:1900|max:' . date('Y'),
            'dob' => 'required|date',
            'gender' => 'required|in:1,2,3',
            'nid_no' => 'required|string|max:30|unique:people,nid',
            'mobile' => 'required|string|max:20|unique:users,mobile',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'father_name' => 'required|string|max:191',
            'location_type' => 'nullable|in:city_type,pos_type,union_type',
            'division_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'thana_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'pos_id' => 'nullable|integer',
            'union_id' => 'nullable|integer',
            'post_office_id' => 'nullable|integer',
            'village_id' => 'nullable|integer',
            'ward_id' => 'nullable|integer',
            'road' => 'nullable|string|max:191',
            'house' => 'nullable|string|max:191',
        ], [
            'nid_no.unique' => 'এই এনআইডি (NID) নম্বরটি ইতিপূর্বে নিবন্ধিত হয়েছে।',
            'mobile.unique' => 'এই মোবাইল নম্বরটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'email.unique' => 'এই ইমেইল ঠিকানাটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'password.confirmed' => 'পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মেলেনি।',
            'dob.date' => 'অনুগ্রহ করে একটি সঠিক জন্ম তারিখ প্রদান করুন।',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'আবেদনপত্র পূরণে কিছু ভুল রয়েছে। অনুগ্রহ করে চেক করুন।',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $user = DB::transaction(function () use ($request, $dob) {
                // 1. Create User in database
                $user = User::create([
                    'name' => $request->name,
                    'bn_name' => $request->bn_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($request->password),
                    'user_type' => 'normal',
                    'role_id' => 5, // Default normal User role
                    'status' => 1,
                    'institute_id' => 3, // Default fallback institute or can be null
                ]);

                // Assign User role via Spatie HasRoles trait
                $user->assignRole('User');

                // 2. Create entry in people table
                People::create([
                    'user_id' => $user->id,
                    'bn_name' => $request->bn_name,
                    'date_of_birth' => $dob,
                    'gender' => $request->gender,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'nid' => $request->nid_no,
                ]);

                // 3. Create entry in family_infos table
                FamilyInfo::create([
                    'user_id' => $user->id,
                    'father_name' => $request->father_name,
                    'father_name_bn' => $request->father_name,
                ]);

                // Build Present Address String
                $addressParts = [];
                if ($request->house)
                    $addressParts[] = "হোল্ডিং: " . $request->house;
                if ($request->road)
                    $addressParts[] = "রোড/গ্রাম: " . $request->road;

                $unionName = null;
                if ($request->location_type == 'union_type' && $request->union_id) {
                    $union = Union::find($request->union_id);
                    if ($union) {
                        $unionName = $union->name;
                        $addressParts[] = "ইউনিয়ন: " . $union->name;
                    }
                } elseif ($request->location_type == 'pos_type' && $request->pos_id) {
                    $pos = Pourashava::find($request->pos_id);
                    if ($pos) {
                        $unionName = $pos->name;
                        $addressParts[] = "পৌরসভা: " . $pos->name;
                    }
                } elseif ($request->location_type == 'city_type' && $request->city_id) {
                    $city = CityCorporation::find($request->city_id);
                    if ($city) {
                        $unionName = $city->bn_name;
                        $addressParts[] = "সিটি কর্পোরেশন: " . $city->bn_name;
                    }
                }

                if ($request->village_id) {
                    $village = Village::find($request->village_id);
                    if ($village)
                        $addressParts[] = "গ্রাম: " . $village->bn_name;
                }
                if ($request->thana_id) {
                    $thana = Thana::find($request->thana_id);
                    if ($thana)
                        $addressParts[] = "থানা: " . $thana->name;
                }
                if ($request->district_id) {
                    $district = District::find($request->district_id);
                    if ($district)
                        $addressParts[] = "জেলা: " . $district->name;
                }

                $fullAddress = implode(', ', $addressParts);

                // 4. Create entry in address_infos table
                AddressInfo::create([
                    'user_id' => $user->id,
                    'present_division_id' => $request->division_id,
                    'present_district_id' => $request->district_id,
                    'present_thana_id' => $request->thana_id,
                    'present_union_id' => ($request->location_type == 'union_type') ? $request->union_id : null,
                    'present_post_office_id' => $request->post_office_id,
                    'present_village_id' => $request->village_id,
                    'present_ward_id' => $request->ward_id,
                    'present_road' => $request->road,
                    'present_house' => $request->house,
                    'present_address' => $fullAddress,
                    'union_name' => $unionName,
                ]);

                return $user;
            });

            // Log the user in
            Auth::login($user);

            return response()->json([
                'status' => true,
                'message' => 'নিবন্ধন সফল হয়েছে! ড্যাশবোর্ডে রিডাইরেক্ট করা হচ্ছে...',
                'redirect_url' => route('frontend.user.dashboard')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'নিবন্ধন ব্যর্থ হয়েছে: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $user = User::with(['peopleProfile', 'familyInfo', 'addressInfo'])->find(Auth::id());

        $mobile = $user->mobile;
        $email = $user->email;
        $nid = $user->peopleProfile->nid ?? '';

        // Query Licenses
        $licenses = License::where('created_by', $user->id)
            ->orWhere('name', 'like', '%' . $user->name . '%')
            ->orderBy('id', 'desc')->get();

        // Query Hotel Restaurants
        $hotels = HotelRestaurant::whereHas('ownership', function ($q) use ($mobile, $nid) {
            $q->where('mobile', $mobile)->orWhere('nid', $nid);
        })->orderBy('id', 'desc')->get();

        // Query Gun Applications (Person, Org, OtherOrg)
        $personGuns = PersonGunApplication::where('phone', $mobile)
            ->orWhere('nid_no', $nid)
            ->orWhere('email', $email)
            ->orderBy('id', 'desc')->get();

        $orgGuns = OrgGunApplication::where('phone', $mobile)
            ->orWhere('email', $email)
            ->orderBy('id', 'desc')->get();

        $otherOrgGuns = OtherOrgGunApplication::where('phone', $mobile)
            ->orWhere('email', $email)
            ->orderBy('id', 'desc')->get();

        // Query Inquiries
        $inquiries = Inquiry::where('mobile_number', $mobile)
            ->orWhere('email', $email)
            ->orWhere('nid_number', $nid)
            ->orderBy('id', 'desc')->get();

        // Query Appointments
        $appointments = AppointmentBooking::where('phone', $mobile)
            ->orWhere('email', $email)
            ->orWhere('nid_number', $nid)
            ->orderBy('id', 'desc')->get();

        // Consolidate Applications
        $applications = [];

        foreach ($licenses as $item) {
            $applications[] = [
                'type' => 'license',
                'service_name' => 'সাধারণ লাইসেন্স',
                'tracking_no' => $item->application_id ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => $item->status ?? 'pending',
                'details' => [
                    'নাম' => $item->name,
                    'বাংলা নাম' => $item->bn_name,
                    'প্রতিষ্ঠানের ধরন' => $item->type->en_name ?? 'N/A',
                    'ক্যাটাগরি' => $item->category->en_name ?? 'N/A',
                    'স্থাপিত সাল' => $item->establish_year ?? 'N/A',
                    'ঠিকানা' => $item->road . ', ' . $item->house,
                ]
            ];
        }

        foreach ($hotels as $item) {
            $applications[] = [
                'type' => 'hotel',
                'service_name' => 'হোটেল ও রেস্তোরাঁ লাইসেন্স',
                'tracking_no' => $item->application_id ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => ($item->status == 1) ? 'approved' : 'pending',
                'details' => [
                    'নাম' => $item->name,
                    'বাংলা নাম' => $item->bn_name,
                    'ক্যাটাগরি' => $item->category->en_name ?? 'N/A',
                    'স্থাপিত সাল' => $item->establish_year ?? 'N/A',
                    'ঠিকানা' => $item->road . ', ' . $item->house,
                ]
            ];
        }

        foreach ($personGuns as $item) {
            $applications[] = [
                'type' => 'person_gun',
                'service_name' => 'ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্স',
                'tracking_no' => $item->tracking_no ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => $item->status ?? 'pending',
                'details' => [
                    'আবেদনকারী' => $item->applicant_name,
                    'এনআইডি' => $item->nid_no,
                    'আগ্নেয়াস্ত্র সংখ্যা' => $item->weapon_count,
                    'আগ্নেয়াস্ত্র বিবরণ' => $item->weapon_details,
                    'বর্তমান অবস্থা' => $item->status,
                ]
            ];
        }

        foreach ($orgGuns as $item) {
            $applications[] = [
                'type' => 'org_gun',
                'service_name' => 'ব্যাংক/আর্থিক প্রতিষ্ঠান আগ্নেয়াস্ত্র লাইসেন্স',
                'tracking_no' => $item->tracking_no ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => $item->status ?? 'pending',
                'details' => [
                    'প্রতিষ্ঠানের নাম' => $item->org_name,
                    'প্রার্থীত আগ্নেয়াস্ত্র সংখ্যা' => $item->weapon_count_requested,
                    'প্রার্থীত আগ্নেয়াস্ত্র ধরন' => $item->weapon_nature_requested,
                    'বর্তমান অবস্থা' => $item->status,
                ]
            ];
        }

        foreach ($otherOrgGuns as $item) {
            $applications[] = [
                'type' => 'other_org_gun',
                'service_name' => 'প্রতিষ্ঠান আগ্নেয়াস্ত্র লাইসেন্স',
                'tracking_no' => $item->tracking_no ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => $item->status ?? 'pending',
                'details' => [
                    'প্রতিষ্ঠানের নাম' => $item->org_name,
                    'প্রার্থীত আগ্নেয়াস্ত্র সংখ্যা' => $item->weapon_count_requested,
                    'প্রার্থীত আগ্নেয়াস্ত্র ধরন' => $item->weapon_nature_requested,
                    'বর্তমান অবস্থা' => $item->status,
                ]
            ];
        }

        foreach ($inquiries as $item) {
            $applications[] = [
                'type' => 'inquiry',
                'service_name' => 'জিজ্ঞাসা ও অভিযোগ',
                'tracking_no' => $item->system_id ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => $item->status ?? 'pending',
                'details' => [
                    'বিষয়' => $item->subject,
                    'অভিযোগকারী' => $item->name,
                    'বর্তমান অবস্থা' => $item->status,
                    'বিবরণ' => $item->description,
                ]
            ];
        }

        foreach ($appointments as $item) {
            $applications[] = [
                'type' => 'appointment',
                'service_name' => 'অ্যাপয়েন্টমেন্ট বুকিং',
                'tracking_no' => $item->system_id ?? 'N/A',
                'date' => $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A',
                'status' => $item->status ?? 'pending',
                'details' => [
                    'অফিসার' => $item->officer->name ?? 'N/A',
                    'তারিখ' => $item->appointment_date,
                    'সময়' => $item->appointment_time,
                    'উদ্দেশ্য' => $item->purpose,
                    'অবস্থা' => $item->status,
                ]
            ];
        }

        // Sort applications by date descending
        usort($applications, function ($a, $b) {
            return strcmp($b['date'], $a['date']);
        });

        // Totals
        $totalApps = count($applications);
        $pendingApps = collect($applications)->whereIn('status', ['pending', 'Submitted', 'pending_approval', '0'])->count();
        $approvedApps = collect($applications)->whereIn('status', ['approved', 'Approved', 'active', '1', 'repaired'])->count();
        $totalBookings = count($appointments);

        return view('frontend.pages.user.dashboard', compact('user', 'applications', 'totalApps', 'pendingApps', 'approvedApps', 'totalBookings'));
    }
}
