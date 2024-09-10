<?php

namespace App\Http\Controllers\Admin\DigitalSignatures;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class DigitalSignatureExcelController extends Controller
{
  public function index(Request $request)
  {

    dd($request->some);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Helloввв World !');

    $writer = new Xlsx($spreadsheet);


    $callback = function () use ($writer) {
      $writer->save('php://output');
    };

    $headers = [
      'Content-Type' => 'application/vnd.ms-excel',
    ];

    return response()->streamDownload($callback, 'Выгрузка ЭЦП.xlsx', $headers);

  }
}
