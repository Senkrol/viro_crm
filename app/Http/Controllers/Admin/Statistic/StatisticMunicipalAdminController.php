<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Models\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Organizations\Organization;

use App\Mail\Admin\Statistics\MunicipalAdminAccess;
use App\Mail\Admin\Statistics\MunicipalAdminAccessUpdate;
use App\Models\Admin\Organizations\OrganizationsDistrict;
use App\Rules\Statistics\UniqueMunicipalAdmin;

class StatisticMunicipalAdminController extends Controller
{
  public function index()
  {
    $municipalAdmins = User::select('users.id', 'users.surname', 'users.name', 'users.patronymic', 'organizations_districts.district_title')
      ->where('admin_type', '=', '2')
      ->leftJoin('organizations_districts', 'users.organization_district_id', '=', 'organizations_districts.id')
      ->paginate(10)->withQueryString();

    return inertia('Admin/Statistics/MunicipalAdmins', ['municipalAdmins' => $municipalAdmins]);
  }

  public function create()
  {

    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', '1')->get();
    $organizations = [];
    return inertia('Admin/Statistics/MunicipalAdminCreateOrUpdate', ['districts' => $districts, 'organizations' => $organizations]);
  }


  public function store(Request $request)
  {

    // php artisan make:mail Admin/Statistics/MunicipalAdminAccess --markdown=mail.admin.statistics.MunicipalAdminAccess

    $organization = Organization::find($request->organization_id['id']);


    $request->validate([
      'organization_id' => ['required', new UniqueMunicipalAdmin]
    ]);



    $municipalAdmin = new User;

    $municipalAdmin->surname = $organization->director_surname;
    $municipalAdmin->name = $organization->director_name;
    $municipalAdmin->patronymic = $organization->director_patronymic;

    $municipalAdmin->possibilitys = implode(',', $request->possibilitys);

    $municipalAdmin->organization_region_id = 1;
    $municipalAdmin->organization_district_id = $request->organization_district_id["id"];
    $municipalAdmin->organization_type_id = 7;
    $municipalAdmin->organization_id = $request->organization_id["id"];

    $municipalAdmin->viro_dolgnost = 'Муниципальный координатор';

    $municipalAdmin->is_admin = true;
    $municipalAdmin->admin_type = 2;
    $municipalAdmin->email_verified_at = date('Y-m-d H:i:s');
    $municipalAdmin->email = $organization->org_email;
    $municipalAdmin->phone = $organization->org_phone;


    $password = Str::password($length = 16, $letters = true, $numbers = true, $symbols = true, $spaces = false);
    $municipalAdmin->password = Hash::make($password);

    $municipalAdmin->save();

    $respectfulЕreatment = $municipalAdmin->name . ' ' . $municipalAdmin->patronymic;
    $login = $municipalAdmin->email;
    Mail::mailer('smtp_viro')
      ->to($login)
      ->send(new MunicipalAdminAccess($respectfulЕreatment, $password, $login));

    return redirect()->route('admin.statistics.municipal.admins.index')->with('success', 'Добавлен региональный координатор!');
  }


  public function edit(User $municipalAdmin): Response
  {

    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', '1')->get();
    $organizations = Organization::select('id', 'short_name')
      ->where('organization_region_id', '=', $municipalAdmin->organization_region_id)
      ->where('organization_district_id', '=', $municipalAdmin->organization_district_id)
      ->where('organization_type_id', '=', $municipalAdmin->organization_type_id)
      ->get();

    $organization = Organization::find($municipalAdmin->organization_id);
    return Inertia::render('Admin/Statistics/MunicipalAdminCreateOrUpdate', [
      'municipalAdmin' => $municipalAdmin,
      'districts' => $districts,
      'organizations' => $organizations,
      'organization' => $organization
    ]);
  }


  public function update(Request $request)
  {
    $organization = Organization::find($request->organization_id['id']);

    $municipalAdmin = User::find($request->id);

    $municipalAdmin->surname = $organization->director_surname;
    $municipalAdmin->name = $organization->director_name;
    $municipalAdmin->patronymic = $organization->director_patronymic;

    $municipalAdmin->possibilitys = implode(',', $request->possibilitys);

    $municipalAdmin->organization_region_id = 1;
    $municipalAdmin->organization_district_id = $request->organization_district_id["id"];
    $municipalAdmin->organization_type_id = 7;
    $municipalAdmin->organization_id = $request->organization_id["id"];


    $municipalAdmin->email = $organization->org_email;
    $municipalAdmin->phone = $organization->org_phone;

    if ($request->passwordUpdate) {
      $password = Str::password($length = 16, $letters = true, $numbers = true, $symbols = false, $spaces = false);
      $municipalAdmin->password = Hash::make($password);

      $respectfulЕreatment = $municipalAdmin->name . ' ' . $municipalAdmin->patronymic;
      $login = $municipalAdmin->email;

      Mail::mailer('smtp_viro')
        ->to($login)
        ->send(new MunicipalAdminAccessUpdate($respectfulЕreatment, $password, $login));
    }

    $municipalAdmin->save();

    return redirect()->route('admin.statistics.municipal.admins.index')->with('success', 'Обновлен региональный координатор!');
  }

  public function delete(User $municipalAdmin)
  {

    $municipalAdmin->delete();

    return redirect()->route('admin.statistics.municipal.admins.index')->with('success', 'Муниципальный координатор удален!');
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
