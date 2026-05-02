<?php

namespace App\Http\Controllers;

use App\Models\Certificate\AgeCertificate;
use App\Models\Certificate\CharacterCertificate;
use App\Models\Certificate\ChildlessCertificate;
use App\Models\Certificate\CitizenCertificate;
use App\Models\Certificate\DisabilityCertificate;
use App\Models\Certificate\FinancialInstabilityCertificate;
use App\Models\Certificate\GuardianCertificate;
use App\Models\Certificate\LandlessCertificate;
use App\Models\Certificate\MarriedCertificate;
use App\Models\Certificate\NameCertificate;
use App\Models\Certificate\NidCorrectionCertificate;
use App\Models\Certificate\OrphanCertificate;
use App\Models\Certificate\PermanentCitizenCertificate;
use App\Models\Certificate\RemarriedCertificate;
use App\Models\Certificate\ResidentialCertificate;
use App\Models\Certificate\UnmarriedCertificate;
use App\Models\Certificate\VoterAreaCertificate;
use App\Models\Certificate\VoterListCertificate;
use App\Models\Certificate\YearlyIncomeCertificate;
use App\Models\House;
use App\Models\Organization\Organization;
use App\Models\Road;
use App\Models\Tax\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['users'] =  DB::table('people')
        ->select('gender', DB::raw('COUNT(*) as count'))
        ->groupBy('gender')
        ->get();
        $data['taxes'] = Tax::count();
        $data['organizations'] = Organization::count();
        $data['houses'] = House::count();
        $data['roads'] = Road::sum('distance');

        $data['age_certificates'] = AgeCertificate::count();
        $data['character_certificates'] = CharacterCertificate::count();
        $data['childless_certificates'] = ChildlessCertificate::count();
        $data['citizen_certificates'] = CitizenCertificate::count();
        $data['disability_certificates'] = DisabilityCertificate::count();
        $data['financial_instability_certificates'] = FinancialInstabilityCertificate::count();
        $data['guardian_certificates'] = GuardianCertificate::count();
        $data['landless_certificates'] = LandlessCertificate::count();
        $data['married_certificates'] = MarriedCertificate::count();
        $data['name_certificates'] = NameCertificate::count();
        $data['nid_correction_certificates'] = NidCorrectionCertificate::count();
        $data['orphan_certificates'] = OrphanCertificate::count();
        $data['permanent_citizen_certificates'] = PermanentCitizenCertificate::count();
        $data['remarried_certificates'] = RemarriedCertificate::count();
        $data['residential_certificates'] = ResidentialCertificate::count();
        $data['unmarried_certificates'] = UnmarriedCertificate::count();
        $data['voter_area_certificates'] = VoterAreaCertificate::count();
        $data['voter_list_certificates'] = VoterListCertificate::count();
        $data['yearly_income_certificates'] = YearlyIncomeCertificate::count();
        
        // return response()->json($data, 200);
        return view('backend.pages.index', $data);
    }
}
