<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\Organization;

use App\Models\Admin\Organizations\OrganizationsType;
use App\Models\Admin\Organizations\OrganizationsRegion;
use App\Models\Admin\Organizations\OrganizationsFounder;
use App\Models\Admin\Organizations\OrganizationsDistrict;

class OrganizationController extends Controller
{

  public function index(Request $request)
  {
    $regions = OrganizationsRegion::get();

    $districts = ($request->region) ? $districts = OrganizationsDistrict::where('organizations_districts.organization_region_id', '=', (int)$request->region)->get() : [];

    $organizations = Organization::select(
      'organizations.id',
      'organizations.short_name',
      'organizations.inn',
      'organizations_regions.region_title',
      'organizations_districts.district_title',
    )
      ->leftJoin('organizations_regions', 'organizations.organization_region_id', '=', 'organizations_regions.id')
      ->leftJoin('organizations_districts', 'organizations.organization_district_id', '=', 'organizations_districts.id')
      ->when($request->region, function ($organizations) use ($request) {
        $organizations->where('organizations.organization_region_id', '=', (int)$request->region);
      })
      ->when($request->district, function ($organizations) use ($request) {
        $organizations->where('organizations.organization_district_id', '=', (int)$request->district);
      })
      ->when($request->search, function ($organizations) use ($request) {
        $organizations->where('short_name', 'like', '%' . $request->search . '%');
      })
      ->paginate(10)->withQueryString();


    return inertia('Admin/Organizations/Organizations', [
      'organizations' => $organizations,
      'regions' => $regions,
      'districts' => $districts,
      'searchTerm' => $request->search,
      'searchRegion' => (int)$request->region,
      'searchDistrict' => (int)$request->district
    ]);
  }


  public function create()
  {
    $regions = OrganizationsRegion::get();
    $districts = []; // определяется в процессе, но оставить надо
    $founders = OrganizationsFounder::select('id', 'founder_title')->get();
    $types = OrganizationsType::get();

    return Inertia::render('Admin/Organizations/OrganizationCreateOrUpdate', ['regions' => $regions, 'districts' => $districts, 'founders' => $founders, 'types' => $types]);
  }


  public function store(Request $request)
  {

    $request->validate([
      'organization_region_id' => 'required',
      'organization_district_id' => 'required',
      'organization_founder_id' => 'required',
      'organization_type_id' => 'required',
      'village_city' => 'required', //не забыть разобраться с массивами
      'short_name' => 'required|string|max:255',
      'full_name' => 'required|string|max:255',
      'okpo' => ['required', 'string', 'max:255', Rule::unique(Organization::class)],
      'inn' => ['required', 'string', 'max:255', Rule::unique(Organization::class)],
      'kpp' => ['required', 'string', 'max:255', Rule::unique(Organization::class)],
      'ogrn' => ['required', 'string', 'max:255', Rule::unique(Organization::class)],
      'code_OU' => ['required', 'string', 'max:255', Rule::unique(Organization::class)],
      'postal_address' => ['required', 'string', 'max:255'],
      'director_surname' => ['required', 'string', 'max:255'],
      'director_name' => ['required', 'string', 'max:255'],
      'director_patronymic' => ['required', 'string', 'max:255'],
      'org_phone' => ['required', 'string', 'max:255'],
      'org_email' => ['required', 'string', 'max:255', 'email', Rule::unique(Organization::class), Rule::unique(User::class, 'email')],
    ]);


    $organization = new Organization;

    $organization->organization_region_id = $request->organization_region_id["id"];
    $organization->organization_district_id = $request->organization_district_id["id"];
    $organization->organization_founder_id = $request->organization_founder_id["id"];
    $organization->organization_type_id = $request->organization_type_id["id"];

    $organization->code_OU = $request->code_OU;
    $organization->full_name = $request->full_name;
    $organization->short_name = $request->short_name;
    $organization->village_city = $request->village_city["id"];

    $organization->postal_address = $request->postal_address;
    $organization->director_surname = $request->director_surname;
    $organization->director_name = $request->director_name;
    $organization->director_patronymic = $request->director_patronymic;
    $organization->okpo = $request->okpo;
    $organization->inn = $request->inn;
    $organization->kpp = $request->kpp;
    $organization->ogrn = $request->ogrn;
    $organization->org_phone = $request->org_phone;
    $organization->org_email = $request->org_email;

    $organization->save();



    return redirect()->route('admin.organizations.organizations.index')->with('success', 'Добавлена организация - «' . $request->short_name . '»!');
  }


  public function edit(Organization $organization): Response
  {

    $regions = OrganizationsRegion::select('id', 'region_title')->get();
    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', $organization->organization_region_id)->get(); // определяется в процессе, но оставить надо
    $founders = OrganizationsFounder::select('id', 'founder_title')->get();
    $types = OrganizationsType::select('id', 'type_title')->get();

    return Inertia::render('Admin/Organizations/OrganizationCreateOrUpdate', [
      'organization' => $organization,
      'regions' => $regions,
      'districts' => $districts,
      'founders' => $founders,
      'types' => $types
    ]);
  }


  public function update(Request $request)
  {
    $admin = User::where('organization_id', '=', $request->id)->first();

    $ignoreAdminID = $admin ? $admin['id'] : 0;


    $request->validate([
      'organization_region_id' => 'required',
      'organization_district_id' => 'required',
      'organization_founder_id' => 'required',
      'organization_type_id' => 'required',
      'village_city' => 'required', //не забыть разобраться с массивами
      'short_name' => 'required|string|max:255',
      'full_name' => 'required|string|max:255',
      'okpo' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($request->id)],
      'inn' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($request->id)],
      'kpp' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($request->id)],
      'ogrn' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($request->id)],
      'code_OU' => ['required', 'string', 'max:255', Rule::unique(Organization::class)->ignore($request->id)],
      'postal_address' => ['required', 'string', 'max:255'],
      'director_surname' => ['required', 'string', 'max:255'],
      'director_name' => ['required', 'string', 'max:255'],
      'director_patronymic' => ['required', 'string', 'max:255'],
      'org_phone' => ['required', 'string', 'max:255'],
      'org_email' => ['required', 'string', 'max:255', 'email', Rule::unique(Organization::class)->ignore($request->id), Rule::unique(User::class, 'email')->ignore($ignoreAdminID)],
    ]);


    $organization = Organization::find($request->id);

    $organization->organization_region_id = $request->organization_region_id["id"];
    $organization->organization_district_id = $request->organization_district_id["id"];
    $organization->organization_founder_id = $request->organization_founder_id["id"];
    $organization->organization_type_id = $request->organization_type_id["id"];

    $organization->code_OU = $request->code_OU;
    $organization->full_name = $request->full_name;
    $organization->short_name = $request->short_name;
    $organization->village_city = $request->village_city["id"];

    $organization->postal_address = $request->postal_address;

    $organization->director_surname = $request->director_surname;
    $organization->director_name = $request->director_name;
    $organization->director_patronymic = $request->director_patronymic;

    $organization->okpo = $request->okpo;
    $organization->inn = $request->inn;
    $organization->kpp = $request->kpp;
    $organization->ogrn = $request->ogrn;

    $organization->org_phone = $request->org_phone;
    $organization->org_email = $request->org_email;

    $organization->save();



    if ($admin) {
      $admin->email = $request->org_email;
      $admin->surname = $request->director_surname;
      $admin->name = $request->director_name;
      $admin->patronymic = $request->director_patronymic;
      $admin->save();
    }

    return redirect()->route('admin.organizations.organizations.index')->with('success', 'Организация «' . $organization->short_name . '» обновлена!');
  }

  public function delete(Organization $organization)
  {
    $organization->delete();
    return redirect()->route('admin.organizations.organization.index')->with('success', 'Организация «' . $organization->short_name . '» удалена!');
  }


  public function getlist(Request $request)
  {
    return Organization::select('id', 'short_name')
      ->where('organization_region_id', '=', $request->region)
      ->where('organization_district_id', '=', $request->district)
      ->where('organization_type_id', '=', $request->type)
      ->get();
  }
}
