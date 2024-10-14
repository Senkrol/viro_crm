<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Organizations\Organization;


class StatisticOrganizationInfoController extends Controller
{
  public function index()
  {


    $admin = Auth::user();


    $municipalAdmin = User::where('admin_type', '=', 2)->where('organization_district_id', '=', $admin->organization_district_id)->get();

    // organization_district_id
    $organization = Organization::select(
      'organizations.id',
      'organizations.code_OU',
      'organizations.full_name',
      'organizations.short_name',
      'organizations.village_city',
      'organizations.postal_address',
      'organizations.director_surname',
      'organizations.director_name',
      'organizations.director_patronymic',
      'organizations.inn',
      'organizations.okpo',
      'organizations.kpp',
      'organizations.ogrn',
      'organizations.org_phone',
      'organizations.org_email',
      'organizations_regions.region_title',
      'organizations_districts.district_title',
      'organizations_founders.founder_title',
      'organizations_types.type_title'
    )
      ->where('organizations.id', '=', $admin['organization_id'])
      ->leftJoin('organizations_regions', 'organizations_regions.id', '=', 'organizations.organization_region_id')
      ->leftJoin('organizations_districts', 'organizations_districts.id', '=', 'organizations.organization_district_id')
      ->leftJoin('organizations_founders', 'organizations_founders.id', '=', 'organizations.organization_founder_id')
      ->leftJoin('organizations_types', 'organizations_types.id', '=', 'organizations.organization_type_id')
      ->get();

    return inertia('Admin/Statistics/OrganizationInfo', [
      'organization' => $organization[0],
      'municipalAdmin' => count($municipalAdmin) ? $municipalAdmin[0] : [],
    ]);
  }


  public function update(Request $request)
  {

    $admin = Auth::user();

    $request->validate([
      'short_name' => 'required|string|max:255',
      'full_name' => 'required|string|max:255',
      'okpo' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($admin->organization_id)],
      'inn' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($admin->organization_id)],
      'kpp' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($admin->organization_id)],
      'ogrn' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($admin->organization_id)],
      'code_OU' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($admin->organization_id)],
      'postal_address' => ['required', 'string', 'max:255'],
      'director_surname' => ['required', 'string', 'max:255'],
      'director_name' => ['required', 'string', 'max:255'],
      'director_patronymic' => ['required', 'string', 'max:255'],
      'org_phone' => ['required', 'string', 'max:255'],
      'org_email' => ['required', 'string', 'max:255', 'email', Rule::unique(Organization::class)->ignore($admin->organization_id), Rule::unique(User::class, 'email')->ignore($admin->id)],
    ]);

    // new isSNILS
    // 'snils' => ['required','string','max:255','unique:' . User::class],
    // 'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,

    $admin = Auth::user();

    $organization = Organization::find($admin->organization_id);

    $organization->short_name = $request->short_name;
    $organization->full_name = $request->full_name;

    $organization->okpo = $request->okpo;
    $organization->inn = $request->inn;
    $organization->kpp = $request->kpp;
    $organization->ogrn = $request->ogrn;
    $organization->code_OU = $request->code_OU;

    $organization->postal_address = $request->postal_address;

    $organization->director_surname = $request->director_surname;
    $organization->director_name = $request->director_name;
    $organization->director_patronymic = $request->director_patronymic;

    $organization->org_phone = $request->org_phone;
    $organization->org_email = $request->org_email;

    $organization->save();

    if ($admin->admin_type !== 1) {
      $admin = User::find($admin->id);
      $admin->email = $request->org_email;
      $admin->surname = $request->director_surname;
      $admin->name = $request->director_name;
      $admin->patronymic = $request->director_patronymic;
      $admin->save();
    }

    return redirect()->route('admin.statistics.organizations.organization.info')->with('success', 'Сведения обновлены!');
  }
}
