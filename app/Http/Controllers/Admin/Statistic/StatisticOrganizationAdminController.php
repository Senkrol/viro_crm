<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Models\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Organizations\Organization;

use App\Mail\Admin\Statistics\MunicipalAdminAccess;
use App\Mail\Admin\Statistics\MunicipalAdminAccessUpdate;
use App\Models\Admin\Organizations\OrganizationsDistrict;
use App\Models\Admin\Organizations\OrganizationsType;
use App\Rules\Statistics\UniqueOrganizationAdmin;

class StatisticOrganizationAdminController extends Controller
{

  public function index(Request $request)
  {


    $admin = Auth::user();

    $district_id = $admin->organization_district_id;

    if ($admin->admin_type == 1 && $request->district) {
      $district_id = $request->district;
    }

    $districts = OrganizationsDistrict::where('organization_region_id', '=', '1')->get();

    $organizationsAdmins = User::select('users.id', 'users.surname', 'users.name', 'users.patronymic', 'organizations.short_name')
      ->where('admin_type', '=', '3')
      ->leftJoin('organizations', 'users.organization_id', '=', 'organizations.id')
      ->where('organizations.organization_district_id', '=', $district_id)
      ->when($request->search, function ($organizationsAdmins) use ($request) {
        $organizationsAdmins->where('organizations.short_name', 'LIKE', '%' . $request->search . '%');
      })
      ->paginate(10)->withQueryString();

    return inertia('Admin/Statistics/OrganizationsAdmins', [
      'organizationsAdmins' => $organizationsAdmins,
      'districts' => $districts,
      'searchDistrict' => (int)$district_id,
      'searchTerm' => $request->search

    ]);
  }

  public function create()
  {

    $admin = Auth::user();

    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', '1')->get();
    $types = OrganizationsType::get();

    $organizations = Organization::select('id', 'short_name')->where('organization_district_id', '=', $admin->organization_district_id)->get();


    return inertia('Admin/Statistics/OrganizationAdminCreateOrUpdate', ['districts' => $districts, 'organizations' => $organizations, 'types' => $types]);
  }



  public function store(Request $request)
  {
   
    // php artisan make:mail Admin/Statistics/MunicipalAdminAccess --markdown=mail.admin.statistics.MunicipalAdminAccess
    $organization = Organization::find($request->organization_id['id']);


    $request->validate([
      'organization_id' => ['required', new UniqueOrganizationAdmin]
    ]);


    $municipalAdmin = new User;

    $municipalAdmin->surname = $organization->director_surname;
    $municipalAdmin->name = $organization->director_name;
    $municipalAdmin->patronymic = $organization->director_patronymic;

    $municipalAdmin->organization_region_id = $organization->organization_region_id;
    $municipalAdmin->organization_district_id = $organization->organization_district_id;
    $municipalAdmin->organization_type_id = $organization->organization_type_id;
    $municipalAdmin->organization_id = $organization->id;
    $municipalAdmin->viro_dolgnost = 'Руководитель организации';
    
    $municipalAdmin->possibilitys = implode(',', $request->possibilitys);
    $municipalAdmin->is_admin = true;
    $municipalAdmin->admin_type = 3;
    $municipalAdmin->email_verified_at = date('Y-m-d H:i:s');
    $municipalAdmin->email = $organization->org_email;
    $municipalAdmin->phone = $organization->org_phone;


    $password = Str::password($length = 16, $letters = true, $numbers = true, $symbols = true, $spaces = false);
    $municipalAdmin->password = Hash::make($password);

    $respectfulЕreatment = $municipalAdmin->name . ' ' . $municipalAdmin->patronymic;
    $login = $municipalAdmin->email;


    Mail::mailer('smtp_viro')
      ->to($login)
      ->send(new MunicipalAdminAccess($respectfulЕreatment, $password, $login));

    $municipalAdmin->save();

    return redirect()->route('admin.statistics.organizations.admins.index')->with('success', 'Добавлен региональный координатор!');
  }


  public function edit(User $organizationAdmin): Response
  {

    $organization = Organization::where('id', '=', $organizationAdmin->organization_id)->get();
    $organizations = Organization::select('id', 'short_name')
      ->where('organization_district_id', '=', $organizationAdmin->organization_district_id)
      ->get();

    $organization = Organization::find($organizationAdmin->organization_id);
    return Inertia::render('Admin/Statistics/OrganizationAdminCreateOrUpdate', [
      'organizationAdmin' => $organizationAdmin,
      'organizations' => $organizations,
      'organization' => $organization,
      'districts' => [],
      'types' => []
    ]);
  }


  public function update(Request $request)
  {


    $organization = Organization::find($request->organization_id['id']);

    $organizationAdmin = User::find($request->id);

    $organizationAdmin->surname = $organization->director_surname;
    $organizationAdmin->name = $organization->director_name;
    $organizationAdmin->patronymic = $organization->director_patronymic;


    $organizationAdmin->organization_region_id = $organization->organization_region_id;
    $organizationAdmin->organization_district_id = $organization->organization_district_id;
    $organizationAdmin->organization_type_id = $organization->organization_type_id;
    $organizationAdmin->organization_id = $organization->id;

    $organizationAdmin->possibilitys = implode(',', $request->possibilitys);

    $organizationAdmin->email = $organization->org_email;
    $organizationAdmin->phone = $organization->org_phone;

    if ($request->passwordUpdate) {
      $password = Str::password($length = 16, $letters = true, $numbers = true, $symbols = false, $spaces = false);
      $organizationAdmin->password = Hash::make($password);

      $respectfulЕreatment = $organizationAdmin->name . ' ' . $organizationAdmin->patronymic;
      $login = $organizationAdmin->email;

      Mail::mailer('smtp_viro')
        ->to($login)
        ->send(new MunicipalAdminAccessUpdate($respectfulЕreatment, $password, $login));
    }

    $organizationAdmin->save();

    return redirect()->route('admin.statistics.organizations.admins.index')->with('success', 'Обновлен региональный координатор!');
  }


  public function GetOrganizationList(Request $request)
  {
    return Organization::select('id', 'short_name')
      ->where('organization_district_id', '=', $request->district)
      ->where('organization_type_id', '=', $request->type)
      ->get();
  }

  public function GetOrganizationInfo(Request $request)
  {
    return Organization::find($request->organization_id);
  }
}
