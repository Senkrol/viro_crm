<?php

namespace App\Http\Controllers\Admin\Administration;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\OrganizationsDistrict;
use App\Models\Admin\Organizations\OrganizationsFounder;
use App\Models\Admin\Organizations\OrganizationsRegion;
use App\Models\Admin\Organizations\OrganizationsType;
use App\Models\Admin\VIRO\VIRODepartment;
use App\Models\User;
use Illuminate\Http\Request;


use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
  public function index(Request $request)
  {
    $admins =  User::where('is_admin', '=', '1')
    ->when($request->search, function ($admins) use ($request) {
      $admins->where('surname', 'like', '%' . $request->search . '%');
    })
    ->paginate(10)->withQueryString();

    return inertia('Admin/Administration/Admins', ['admins' => $admins, 'searchTerm' => $request->search]);
  }

  public function create()
  {
    $regions = OrganizationsRegion::get();
    $districts = []; // определяется в процессе
    $types = OrganizationsType::select('id', 'type_title')->get();
    $organizations = []; // определяется в процессе
    $departments = VIRODepartment::select('id', 'title')->get();


    return Inertia::render('Admin/Administration/AdminCreateOrUpdate', [
      'regions' => $regions,
      'districts' => $districts,
      'types' => $types,
      'organizations' => $organizations,
      'departments' => $departments
    ]);
  }


  public function store(Request $request)
  {

    $admin = new User();

    $admin->name = $request->name;
    $admin->surname = $request->surname;
    $admin->patronymic = $request->patronymic;

    $admin->possibilitys = implode(',', $request->possibilitys);

    $admin->organization_region_id = $request->organization_region_id["id"];
    $admin->organization_district_id = $request->organization_district_id["id"];
    $admin->organization_type_id = $request->organization_type_id["id"];
    $admin->organization_id = $request->organization_id["id"];

    $admin->viro_department = $request->viro_department["id"];
    $admin->viro_dolgnost = $request->viro_dolgnost;
    $admin->phone = $request->phone;

    $admin->is_admin = true;
    $admin->email_verified_at = date('Y-m-d H:i:s');
    $admin->email = $request->email;
    $admin->password = Hash::make($request->password);
    $admin->save();

    return redirect()->route('admin.administration.admins.index')->with('success', 'Администратор «' . $request->name . '» - создан!');
  }


  public function edit(User $admin): Response
  {



    $regions = OrganizationsRegion::select('id', 'region_title')->get();
    $districts = OrganizationsDistrict::select('id', 'district_title')->where('organization_region_id', '=', $admin->organization_region_id)->get();
    $founders = OrganizationsFounder::select('id', 'founder_title')->get();
    $types = OrganizationsType::select('id', 'type_title')->get();
    $departments = VIRODepartment::select('id', 'title')->get();


    $organizations = Organization::select('id', 'short_name')
      ->where('organization_region_id', '=', $admin->organization_region_id)
      ->where('organization_district_id', '=', $admin->organization_district_id)
      ->where('organization_type_id', '=', $admin->organization_type_id)
      ->get();


    return Inertia::render('Admin/Administration/AdminCreateOrUpdate', [
      'admin' => $admin,
      'regions' => $regions,
      'districts' => $districts,
      'founders' => $founders,
      'types' => $types,
      'organizations' => $organizations,
      'departments' => $departments
    ]);
  }


  public function update(Request $request)
  {

    $admin = User::find($request->id);

    $admin->name = $request->name;
    $admin->surname = $request->surname;
    $admin->patronymic = $request->patronymic;

    $admin->possibilitys = implode(',', $request->possibilitys);

    $admin->organization_region_id = $request->organization_region_id["id"];
    $admin->organization_district_id = $request->organization_district_id["id"];
    $admin->organization_type_id = $request->organization_type_id["id"];
    $admin->organization_id = $request->organization_id["id"];

    $admin->viro_department = $request->viro_department["id"];
    $admin->viro_dolgnost = $request->viro_dolgnost;
    $admin->phone = $request->phone;

    $admin->email = $request->email;
    if (trim($request->password)) {
      $admin->password = Hash::make($request->password);
    }



    $admin->save();

    return redirect()->route('admin.administration.admins.index')->with('success', 'Администратор «' . $request->name . '» - обновлен!');
  }
}
