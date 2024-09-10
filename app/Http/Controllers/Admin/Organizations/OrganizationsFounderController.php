<?php

namespace App\Http\Controllers\Admin\Organizations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Organizations\OrganizationsFounder;

use Inertia\Inertia;
use Inertia\Response;

class OrganizationsFounderController extends Controller
{

  public function index()
  {
    $founders = OrganizationsFounder::get();
    return inertia('Admin/Organizations/Founders', ['founders' => $founders]);
  }


  public function create()
  {
    return Inertia::render('Admin/Organizations/FounderCreateOrUpdate');
  }

  public function store(Request $request)
  {

    $founder = new OrganizationsFounder;
    $founder->founder_title = $request->founder_title;
    
    $founder->save();

    return redirect()->route('admin.organizations.founders.index')->with('success', 'Учредитель «'.$request->founder_title.'» создан!');
  }

  public function edit(OrganizationsFounder $founder): Response
  {
    return Inertia::render('Admin/Organizations/FounderCreateOrUpdate', [
      'founder' => $founder,
    ]);
  }

  public function update(Request $request)
  {

    $founder = OrganizationsFounder::find($request->id);

    $founder->founder_title = $request->founder_title;

    $founder->save();

    return redirect()->route('admin.organizations.founders.index')->with('success', 'Учредитель «'.$request->founder_title.'» обновлен!');
  }
  public function delete(OrganizationsFounder $founder)
  {

    $founder->delete();

    return redirect()->route('admin.organizations.founders.index')->with('success', 'Учредитель «'.$founder->founder_title.'» удален!');
  }
}
