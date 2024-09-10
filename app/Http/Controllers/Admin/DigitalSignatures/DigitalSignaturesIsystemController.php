<?php

namespace App\Http\Controllers\Admin\DigitalSignatures;

use App\Http\Controllers\Controller;
use App\Models\Admin\DigitalSignatures\DigitalSignaturesIsystem;
use Illuminate\Http\Request;


use Inertia\Inertia;
use Inertia\Response;

class DigitalSignaturesIsystemController extends Controller
{


  public function index()
  {

    $isystems = DigitalSignaturesIsystem::get();

    return inertia('Admin/DigitalSignatures/DigitalSignaturesIsystems', ['isystems' => $isystems]);
  }


  public function create()
  {
    return Inertia::render('Admin/DigitalSignatures/DigitalSignaturesIsystemCreateOrUpdate');
  }


  public function store(Request $request)
  {

    $isystem = new DigitalSignaturesIsystem;
    $isystem->title = $request->title;
    $isystem->save();

    return redirect()->route('admin.digital-signatures.isystems.index')->with('success', 'Ну вот создал ты ИС и хули дальше?');
  }


  public function edit(DigitalSignaturesIsystem $isystem): Response
  {
    return Inertia::render('Admin/DigitalSignatures/DigitalSignaturesIsystemCreateOrUpdate', [
      'isystem' => $isystem,
    ]);
  }

  public function update(Request $request)
  {

    $flight = DigitalSignaturesIsystem::find($request->id);

    $flight->title = $request->title;

    $flight->save();

    return redirect()->route('admin.digital-signatures.isystems.index')->with('success', 'Ну обновил ты ИС и че теперь, доволен?');
  }
  public function delete(DigitalSignaturesIsystem $isystem)
  {


    $isystem->delete();

    return redirect()->route('admin.digital-signatures.isystems.index')->with('success', 'Ну удалил ты ИС и чего, герой теперь?');
  }

  
}
