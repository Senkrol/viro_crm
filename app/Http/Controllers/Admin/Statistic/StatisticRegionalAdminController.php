<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Admin\Statistics\RegionalAdminAccess;
use App\Mail\Admin\Statistics\RegionalAdminAccessUpdate;
use Illuminate\Support\Facades\Mail;

use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\OrganizationsDistrict;
use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;
use Inertia\Response;

class StatisticRegionalAdminController extends Controller
{
  public function index()
  {
    $regionalAdmins = User::select('users.id', 'users.surname', 'users.name', 'users.patronymic', 'organizations_districts.district_title')
      ->where('admin_type', '=', '2')
      ->leftJoin('organizations_districts', 'users.organization_district_id', '=', 'organizations_districts.id')
      ->paginate(10)->withQueryString();

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

    // php artisan make:mail Admin/Statistics/RegionalAdminAccess --markdown=mail.admin.statistics.RegionalAdminAccess
    $organization = Organization::find($request->organization_id['id']);


    $regionalAdmin = new User;

    $regionalAdmin->name = $request->name;
    $regionalAdmin->surname = $request->surname;
    $regionalAdmin->patronymic = $request->patronymic;

    $regionalAdmin->possibilitys = "бимбимбамбам";

    $regionalAdmin->organization_region_id = 1;
    $regionalAdmin->organization_district_id = $request->organization_district_id["id"];
    $regionalAdmin->organization_type_id = 7;
    $regionalAdmin->organization_id = $request->organization_id["id"];

    $regionalAdmin->is_admin = true;
    $regionalAdmin->admin_type = 2;
    $regionalAdmin->email_verified_at = date('Y-m-d H:i:s');
    $regionalAdmin->email = $organization->org_email;
    $regionalAdmin->phone = $organization->org_phone;


    $password = Str::password(16);
    $regionalAdmin->password = Hash::make(Str::password(16));

    $respectfulЕreatment = $request->name . ' ' . $request->patronymic;
    $login = $organization->org_email;


    Mail::mailer('smtp_viro')
      ->to($organization->org_email)
      ->send(new RegionalAdminAccess($respectfulЕreatment, $password, $login));

    $regionalAdmin->save();

    return redirect()->route('admin.statistics.regional.admins.index')->with('success', 'Добавлен региональный координатор!');
  }


  public function edit(User $regionalAdmin): Response
  {

    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', '1')->get();
    $organizations = Organization::select('id', 'short_name')
      ->where('organization_region_id', '=', $regionalAdmin->organization_region_id)
      ->where('organization_district_id', '=', $regionalAdmin->organization_district_id)
      ->where('organization_type_id', '=', $regionalAdmin->organization_type_id)
      ->get();

    $organization = Organization::find($regionalAdmin->organization_id);
    return Inertia::render('Admin/Statistics/RegionalAdminCreateOrUpdate', [
      'regionalAdmin' => $regionalAdmin,
      'districts' => $districts,
      'organizations' => $organizations,
      'organization' => $organization
    ]);
  }


  public function update(Request $request)
  {


    $organization = Organization::find($request->organization_id['id']);

    $regionalAdmin = User::find($request->id);

    $regionalAdmin->name = $request->name;
    $regionalAdmin->surname = $request->surname;
    $regionalAdmin->patronymic = $request->patronymic;


    $regionalAdmin->organization_region_id = 1;
    $regionalAdmin->organization_district_id = $request->organization_district_id["id"];
    $regionalAdmin->organization_type_id = 7;
    $regionalAdmin->organization_id = $request->organization_id["id"];


    $regionalAdmin->email = $organization->org_email;
    $regionalAdmin->phone = $organization->org_phone;

    if ($request->passwordUpdate) {
      $password = Str::password(16);
      $regionalAdmin->password = Hash::make(Str::password(16));

      $respectfulЕreatment = $request->name . ' ' . $request->patronymic;
      $login = $organization->org_email;

      Mail::mailer('smtp_viro')
        ->to($organization->org_email)
        ->send(new RegionalAdminAccessUpdate($respectfulЕreatment, $password, $login));
    }

    $regionalAdmin->save();

    return redirect()->route('admin.statistics.regional.admins.index')->with('success', 'Обновлен региональный координатор!');
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
