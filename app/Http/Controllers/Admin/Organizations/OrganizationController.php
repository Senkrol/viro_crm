<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\OrganizationsDistrict;
use App\Models\Admin\Organizations\OrganizationsFounder;
use App\Models\Admin\Organizations\OrganizationsRegion;
use App\Models\Admin\Organizations\OrganizationsType;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

class OrganizationController extends Controller
{


  public function index()
  {
    $organizations = Organization::select(
      'organizations.id',
      'organizations.short_name',
      'organizations.inn',
      'organizations_regions.region_title',
      'organizations_districts.district_title',
    )
      ->leftJoin('organizations_regions', 'organizations.organization_region_id', '=', 'organizations_regions.id')
      ->leftJoin('organizations_districts', 'organizations.organization_district_id', '=', 'organizations_districts.id')
      ->paginate(10)->withQueryString();

    return inertia('Admin/Organizations/Organizations', ['organizations' => $organizations]);
  }


  public function create()
  {
    $regions = OrganizationsRegion::get();
    $districts = []; // определяется в процессе, но оставить надо
    $founders = OrganizationsFounder::select('id', 'founder_title')->get();
    $types = OrganizationsType::select('id', 'type_title')->get();

    return Inertia::render('Admin/Organizations/OrganizationCreateOrUpdate', ['regions' => $regions, 'districts' => $districts, 'founders' => $founders, 'types' => $types]);
  }


  public function store(Request $request)
  {

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
    $organization->inn = $request->inn;
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

    $organization->inn = $request->inn;
    $organization->org_phone = $request->org_phone;
    $organization->org_email = $request->org_email;

    $organization->save();

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
