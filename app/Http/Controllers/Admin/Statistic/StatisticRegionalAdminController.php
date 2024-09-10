<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Admin\Statistics\RegionalAdminAccess;
use Illuminate\Support\Facades\Mail;

use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Statistics\StatisticsRegionalAdmin;
use App\Models\Admin\Organizations\OrganizationsDistrict;

class StatisticRegionalAdminController extends Controller
{
  public function index()
  {
    $regionalAdmins = StatisticsRegionalAdmin::paginate(10)->withQueryString();

    return inertia('Admin/Statistics/RegionalAdmins', ['regionalAdmins' => $regionalAdmins]);
  }

  public function create()
  {
    // взят 35й регион
    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', '1')->get();
    $organizations = [];
    return inertia('Admin/Statistics/RegionalAdminCreateOrUpdate', ['districts' => $districts, 'organizations' => $organizations]);
  }



  public function store(Request $request)
  {


    $regionalAdmin = new User;

    $password = Str::password(16);
    //php artisan make:mail Admin/Statistics/RegionalAdminAccess --markdown=mail.admin.statistics.RegionalAdminAccess


    $organization = Organization::find($request->organization_district_id['id']);


    $respectfulЕreatment = $request->name . ' ' . $request->patronymic;
    $login = $organization->org_email;


    Mail::mailer('smtp_viro')
      ->to('senkrol.srw@gmail.com')
      ->send(new RegionalAdminAccess($respectfulЕreatment, $password, $login));

    dd($password);

    $regionalAdmin->save();

    return redirect()->route('admin.organizations.organizations.index')->with('success', 'Добавлена организация - «' . $request->short_name . '»!');
  }



  public function GetOrganizationList(Request $request)
  {
    return Organization::select('id', 'short_name')
      ->where('organization_region_id', '=', $request->region)
      ->where('organization_district_id', '=', $request->district)
      ->where('organization_type_id', '=', $request->type)
      ->get();
  }

  public function GetOrganizationInfo(Request $request)
  {
    
    return Organization::find($request->organization_id);
  }
}
