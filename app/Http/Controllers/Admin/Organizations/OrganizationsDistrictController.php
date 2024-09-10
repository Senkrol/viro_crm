<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\OrganizationsDistrict;
use App\Models\Admin\Organizations\OrganizationsRegion;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

class OrganizationsDistrictController extends Controller
{
  public function index()
  {
    $districts = OrganizationsDistrict::select('organizations_districts.*','organizations_regions.region_title')
    ->leftJoin('organizations_regions', 'organizations_districts.organization_region_id', '=', 'organizations_regions.id')->paginate(10)->withQueryString();

    return inertia('Admin/Organizations/Districts', ['districts' => $districts]);
  }

  public function create()
  {

    $regions = OrganizationsRegion::select('id', 'region_title')->get();

    return Inertia::render('Admin/Organizations/DistrictCreateOrUpdate',['regions' => $regions]);
  }


  public function store(Request $request)
  {
    $district = new OrganizationsDistrict;
    $district->district_number = $request->district_number;
    $district->district_title = $request->district_title;
    $district->organization_region_id = $request->organization_region_id["id"];
    
    $district->save();

    return redirect()->route('admin.organizations.districts.index')->with('success', 'Добавлена область - «'.$request->district_title.'»!');
  }


  public function edit(OrganizationsDistrict $district): Response
  {
    $regions = OrganizationsRegion::select('id', 'region_title')->get();

    return Inertia::render('Admin/Organizations/DistrictCreateOrUpdate', [
      'district' => $district, 'regions' => $regions
    ]);
  }


  public function update(Request $request)
  {

    $district = OrganizationsDistrict::find($request->id);

    $district->district_number = $request->district_number;
    $district->district_title = $request->district_title;
    $district->organization_region_id = $request->organization_region_id["id"];

    $district->save();

    return redirect()->route('admin.organizations.districts.index')->with('success', 'Регион «'.$request->district_title.'» обновлен!');
  }

  public function delete(OrganizationsDistrict $district)
  {
    $district->delete();
    return redirect()->route('admin.organizations.districts.index')->with('success', 'Регион «'.$district->district_title.'» удален!');
  }

  public function getlist(Request $request)
  {
    return OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id','=',$request->id)->get();
  }
  

}
