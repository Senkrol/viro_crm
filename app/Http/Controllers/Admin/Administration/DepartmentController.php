<?php

namespace App\Http\Controllers\Admin\Administration;

use App\Http\Controllers\Controller;
use App\Models\Admin\VIRO\VIRODepartment;
use Illuminate\Http\Request;


use Inertia\Inertia;
use Inertia\Response;

class DepartmentController extends Controller
{

  public function index()
  {
    $departments = VIRODepartment::get();
    return inertia('Admin/Administration/Departments', ['departments' => $departments]);
  }


  public function create()
  {
    return Inertia::render('Admin/Administration/DepartmentCreateOrUpdate');
  }

  public function store(Request $request)
  {
    
    $department = new VIRODepartment;
    $department->title = $request->title;
    
    $department->save();

    return redirect()->route('admin.administration.departments.index')->with('success', 'Отдел «'.$request->title.'» создан!');
  }

  public function edit(VIRODepartment $department): Response
  {
    return Inertia::render('Admin/Administration/DepartmentCreateOrUpdate', [
      'department' => $department,
    ]);
  }

  public function update(Request $request)
  {

    $department = VIRODepartment::find($request->id);

    $department->title = $request->title;

    $department->save();

    return redirect()->route('admin.administration.departments.index')->with('success', 'Отдел «'.$request->title.'» обновлен!');
  }
  public function delete(VIRODepartment $department)
  {

    $department->delete();

    return redirect()->route('admin.administration.departments.index')->with('success', 'Отдел «'.$department->title.'» удален!');
  }

}
