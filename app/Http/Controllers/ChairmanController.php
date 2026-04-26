<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
use App\Models\People\AddressInfo;
use App\Models\People\AreaInfo;
use App\Models\People\ChairmanAreaInfo;
use App\Models\People\CouncilMemberHistory;
use App\Models\People\CharimanAreaDetail;
use App\Models\People\EducationalInfo;
use App\Models\People\FinancialInfo;
use App\Models\People\DisabilityInfo;
use App\Models\People\PropertyInfo;
use App\Models\People\FreedomFighterInfo;
use App\Models\BasicSettings\Profession;
use App\Models\People\FamilyInfo;
use App\Models\ChairmanMayor;
use App\Models\Council;
use App\Models\CouncilMember;
use App\Models\Religion;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\BasicSettings\Country;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ChairmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['councils']=Council::paginate(100);
      return view('backend.pages.chairman.index', $data);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] =  District::where('status', true)->orderBy('name')->get(); 
        $data['countries'] =  Country::orderBy('name')->get(); 
        $data['divisions'] = Division::latest()->get();
        return view('backend.pages.chairman.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function personalstore(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {

                $council = new Council();
                $council->union_id=$request->union_id;
                $council->start_date=date('Y-m-d',strtotime($request->start_date));
                $council->end_date=date('Y-m-d',strtotime($request->end_date));
                $council->status=1;
                if ($council->save()) {
                   $wordTitles=[
                    2=>'ওয়ার্ড নং-১',
                    3=>'ওয়ার্ড নং-২',
                    4=>'ওয়ার্ড নং-৩',
                    5=>'ওয়ার্ড নং-৪',
                    6=>'ওয়ার্ড নং-৫',
                    7=>'ওয়ার্ড নং-৬',
                    8=>'ওয়ার্ড নং-৭',
                    9=>'ওয়ার্ড নং-৮',
                    10=>'ওয়ার্ড নং-৯',
                    11=>'ওয়ার্ড নং-১ (১,২,৩)',
                 12=>'ওয়ার্ড নং-২ (৪,৫,৬)',
                 13=>'ওয়ার্ড নং-৩ (৭,৮,৯)', 
                ];

                for($i=1;$i<15;$i++){
                    if($i==1){
                        $position=1;
                        $word_no_text='';
                    }else if($i>1 && $i < 11){
                        $position=2;
                        $word_no_text=$wordTitles[$i];

                    }elseif($i>10 && $i<14){
                        $position=3;  
                        $word_no_text=$wordTitles[$i];                          
                    }
                    else{
                        $position=4;
                        $word_no_text='';
                    }
                    $cmember=new CouncilMember;
                    $cmember->council_id=$council->id;
                    $cmember->word_no_text=$word_no_text;

                    $cmember->user_id=$request->userinfo[$i-1];
                    $cmember->concilor_designation_id=$position;
                    $cmember->start_date=date('Y-m-d',strtotime($request->start_date));
                    $cmember->end_date=date('Y-m-d',strtotime($request->end_date));
                    $cmember->status=1;
                    $cmember->order=$i;

                    $cmember->save();

                }
                $data['status'] = true;
                $data['message'] = "Council saved successfully.";

                $data['code'] = 200;
                $data['redirect_url'] = route('chairman.index');
                return $data;
            } else {
                $data['status'] = false;
                $data['message'] = "People save failed! Please try again...";
                $data['people'] = $people;
                $data['code'] = 500;
                return $data;
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['code'] = 500;
            $data['errors'] = $th;
            $data['message'] = "Something went wrong! Please try again or contact on support...";

            return $data;
        }
    });
        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    function fetch(Request $request)
    {
       if($request->get('query'))
       {
          $query = $request->get('query');
          $data = DB::table('users')
          ->join('people','users.id','=','people.user_id')
          ->where('system_id', 'LIKE', "%{$query}%")
          ->get();
          $output = '<ul class="dropdown-menu" style="display:block; ">';
          foreach($data as $row)
          {
             $output .= '
             <li class="droplist" id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
             ';
         }
         $output .= '</ul>';
         echo $output;
     }
 }

 public function getPeopleByUnion(Request $request, $id){
    $html = '<option value="">Select Select</option>';

    $thanas = AddressInfo::where('present_union_id', $id)->get();
    if(count($thanas)) {
        foreach ($thanas as $thana) {
         $html .='<option value="'.$thana->user_id.'">'.$thana->User->system_id.' : '.$thana->User->name.'</option>';
     }
 }

 return $html;
}

public function edit($id)
{
    $data['religions'] = Religion::where('status', true)->get();
    $data['districts'] =  District::where('status', true)->orderBy('name')->get(); 
    $data['countries'] =  Country::orderBy('name')->get(); 
    $data['divisions'] = Division::latest()->get();


    $council= Council::find($id);
    $data['council'] =$council;
    $data['districts'] = District::where('division_id',$council->union->Thana->District->division_id)->get();

    $data['thanas'] = Thana::where('district_id',$council->union->Thana->district_id)->get();
    $data['unions'] = Union::where('thana_id',$council->union->thana_id)->get();
    $data['chairmans']=AddressInfo::where('present_union_id', $council->union_id)->get();

    return view('backend.pages.chairman.edit', $data);
}

public function show($id)
{
    $data['council'] = Council::find($id);
    return view('backend.pages.chairman.show', $data);
}


public function fromupdate(Request $request)
{


    $validate = Validator::make($request->all(), [
        'start_date' => 'required',
        'end_date' => 'required',

    ]);
// dd($request);
    if ($validate->fails()) {
        $data['status'] = false;
        $data['message'] = "Sorry! Invalid Entry.";
        $data['errors'] = $validate->errors();
        return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
    }

    $result = DB::transaction(function () use ($request) {
        try {         

            $id=$request->id;       
            $council = Council::find($id);
            $council->union_id=$request->union_id;
            $council->start_date=date('Y-m-d',strtotime($request->start_date));
            $council->end_date=date('Y-m-d',strtotime($request->end_date));
            $council->status=$request->status;
            $save=$council->save();

            if ($save) {

                CouncilMember::where('council_id',$id)->delete();

                for($i=1;$i<15;$i++){
                    if($i==1){
                        $position=1;
                    }else if($i>1 && $i < 11){
                        $position=2;
                    }elseif($i>10 && $i<14){
                        $position=3;

                    }
                    else{
                        $position=4;
                    }
                    $cmember=new CouncilMember;
                    $cmember->council_id=$council->id;
                    $cmember->user_id=$request->userinfo[$i-1];
                    $cmember->concilor_designation_id=$position;
                    $cmember->start_date=date('Y-m-d',strtotime($request->start_date));
                    $cmember->end_date=date('Y-m-d',strtotime($request->end_date));
                    $cmember->status=1;
                    $cmember->order=$i;

                    $csave=$cmember->save();                    
                }
                $data['status'] = true;
                $data['message'] = "Council Update successfully.";

                $data['code'] = 200;
                $data['redirect_url'] = route('chairman.index');
                return $data;
            } else {
                $data['status'] = false;
                $data['message'] = "People save failed! Please try again...";
                $data['people'] = $people;
                $data['code'] = 500;
                return $data;
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['code'] = 500;
            $data['errors'] = $th;
            $data['message'] = "Something went wrong! Please try again or contact on support...";

            return $data;
        }
    });
    return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
}

public function changeMember($id){
    $cm=CouncilMember::find($id);
    $council =Council::find($cm->council_id);
    $data['chairmans']=AddressInfo::where('present_union_id', $council->union_id)->get();
    $data['council']=$council;
    $data['cm']=$cm;
    return view('backend.pages.chairman.show_single', $data);
}

public function councilorUpdate(Request $request){


    $result = DB::transaction(function () use ($request) {
        try {      
           $comh=new CouncilMemberHistory;
           $comh->council_id=$request->council_id;
           $comh->council_member_id=$request->council_member_id;
           $comh->user_id=$request->user_id;
           $comh->concilor_designation_id=$request->concilor_designation_id;
           $comh->word_no_text=$request->word_no_text;
           $comh->start_date=date('Y-m-d',strtotime($request->start_date));
           $comh->end_date=date('Y-m-d',strtotime($request->end_date));
           $comh->reason=$request->reason;
           $comh->note=$request->note;
           $comh->status=2;
           $comh->order=$request->order;
           $comh->save();

           $cm=CouncilMember::find($request->council_member_id);
           $cm->user_id=$request->member_id;
           $cm->start_date=date('Y-m-d',strtotime($request->new_start_date));
           $cm->end_date=date('Y-m-d',strtotime($request->new_end_date));
           $cm->status=$request->status;
           $cm->save();



           $data['status'] = true;
           $data['message'] = "Council Update successfully.";
           $data['code'] = 200;
           $data['redirect_url'] = route('chairman.index');
           return $data;

       } catch (\Throwable $th) {
        $data['status'] = false;
        $data['code'] = 500;
        $data['errors'] = $th;
        $data['message'] = "Something went wrong! Please try again or contact on support...";

        return $data;
    }
});

    return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
}



}
