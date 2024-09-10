<?php

namespace App\Http\Controllers\Admin\DigitalSignatures;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\Admin\DigitalSignatures\DigitalSignature;
use App\Models\Admin\DigitalSignatures\DigitalSignaturesIsystem;

class DigitalSignatureController extends Controller
{


  public function index()
  {

    $digitalSignatures = DigitalSignature::select('digital_signatures.id', 'digital_signatures.serial_number', 'digital_signatures.date_start', 'digital_signatures.date_end', 'digital_signatures.order_number', 'digital_signatures_isystems.title', 'users.name')
      ->leftJoin('digital_signatures_isystems', 'digital_signatures.digital_signatures_isystems_id', '=', 'digital_signatures_isystems.id')
      ->leftJoin('users', 'digital_signatures.user_id', '=', 'users.id')
      ->get();

    return inertia('Admin/DigitalSignatures/DigitalSignatures', ['digitalSignatures' => $digitalSignatures]);
  }


  public function create()
  {
    $users = User::select('id', 'name')->where('isAdmin', 1)->get();
    $isystems = DigitalSignaturesIsystem::select('id', 'title')->get();

    return Inertia::render('Admin/DigitalSignatures/DigitalSignatureCreateOrUpdate', ['users' => $users, 'isystems' => $isystems]);
  }


  public function store(Request $request)
  {


    $digitalSignature = new DigitalSignature;

    $digitalSignature->order_number = $request->order_number;
    $digitalSignature->digital_signatures_isystems_id = $request->digital_signatures_isystems_id['id'];
    $digitalSignature->user_id = $request->user_id['id'];
    $digitalSignature->serial_number = $request->serial_number;
    $digitalSignature->date_start = date('Y-m-d', strtotime($request->date_start));
    $digitalSignature->date_end = date('Y-m-d', strtotime($request->date_end));


    $digitalSignature->save();

    return redirect()->route('admin.digital-signatures.digital-signatures.index')->with('success', 'Ебать, выдал он ключ, и че теперь?');
  }


  public function edit(DigitalSignature $digitalSignature): Response
  {

    $uses = User::select('id', 'name')->where('isAdmin', 1)->get();
    $isystems = DigitalSignaturesIsystem::select('id', 'title')->get();

    return Inertia::render('Admin/DigitalSignatures/DigitalSignatureCreateOrUpdate', [
      'digitalSignature' => $digitalSignature, 'uses' => $uses, 'isystems' => $isystems
    ]);
  }

  public function update(Request $request)
  {

    $validatedData = $request->validate([
      'order_number' => ['required','numeric'],
    ]);


    $digitalSignature = DigitalSignature::find($request->id);

    $digitalSignature->order_number = $validatedData['order_number'];
    $digitalSignature->digital_signatures_isystems_id = $request->digital_signatures_isystems_id['id'];
    $digitalSignature->user_id = $request->user_id['id'];
    $digitalSignature->serial_number = $request->serial_number;
    $digitalSignature->date_start = date('Y-m-d', strtotime($request->date_start));
    $digitalSignature->date_end = date('Y-m-d', strtotime($request->date_end));

    $digitalSignature->save();

    return redirect()->route('admin.digital-signatures.digital-signatures.index')->with('success', 'Ну обновил я данные пл ключу, и хули? он лучше стал?');
  }
  public function delete(DigitalSignature $digitalSignature)
  {

    $digitalSignature->delete();

    return redirect()->route('admin.digital-signatures.digital-signatures.index')->with('success', 'Ну давай, блять, мыж миллионеры! Хуярь ключи и дальше!');
  }
}
