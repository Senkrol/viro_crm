<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\OrganizationsRegion;
use Illuminate\Http\Request;


use Inertia\Inertia;
use Inertia\Response;

class OrganizationsRegionController extends Controller
{
  public function index()
  {
    $regions = OrganizationsRegion::paginate(10)->withQueryString();
    
    return inertia('Admin/Organizations/Regions', ['regions' => $regions]);
  }


  public function create()
  {
    return Inertia::render('Admin/Organizations/RegionCreateOrUpdate');
  }

  public function store(Request $request)
  {

    $region = new OrganizationsRegion;
    $region->region_number = $request->region_number;
    $region->region_title = $request->region_title;
    
    $region->save();

    return redirect()->route('admin.organizations.regions.index')->with('success', 'Регион «'.$request->region_title.'» создан!');
  }

  public function edit(OrganizationsRegion $region): Response
  {
    return Inertia::render('Admin/Organizations/RegionCreateOrUpdate', [
      'region' => $region,
    ]);
  }

  public function update(Request $request)
  {

    $region = OrganizationsRegion::find($request->id);

    $region->region_number = $request->region_number;
    $region->region_title = $request->region_title;

    $region->save();

    return redirect()->route('admin.organizations.regions.index')->with('success', 'Регион «'.$request->region_title.'» обновлен!');
  }
  public function delete(OrganizationsRegion $region)
  {

    $region->delete();

    return redirect()->route('admin.organizations.regions.index')->with('success', 'Регион «'.$region->region_title.'» удален!');
  }
}
