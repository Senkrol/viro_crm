<?php

namespace App\Http\Controllers\Admin\Organizations;

use Inertia\Inertia;
use Inertia\Response;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\OrganizationsType;

class OrganizationsTypeController extends Controller
{
  public function index()
  {
    $types = OrganizationsType::get();
    return inertia('Admin/Organizations/Types', ['types' => $types]);
    
  }

  public function create()
  {
    return Inertia::render('Admin/Organizations/TypeCreateOrUpdate');
  }

  public function store(Request $request)
  {

    $type = new OrganizationsType;
    $type->type_title = $request->type_title;
    
    $type->save();

    return redirect()->route('admin.organizations.types.index')->with('success', 'Тип «'.$request->type_title.'» создан!');
  }

  public function edit(OrganizationsType $type): Response
  {
    return Inertia::render('Admin/Organizations/TypeCreateOrUpdate', [
      'type' => $type,
    ]);
  }

  public function update(Request $request)
  {

    $type = OrganizationsType::find($request->id);

    $type->type_title = $request->type_title;

    $type->save();

    return redirect()->route('admin.organizations.types.index')->with('success', 'Тип «'.$request->type_title.'» обновлен!');
  }
  public function delete(OrganizationsType $type)
  {

    $type->delete();

    return redirect()->route('admin.organizations.types.index')->with('success', 'Тип «'.$type->type_title.'» удален!');
  }

}
