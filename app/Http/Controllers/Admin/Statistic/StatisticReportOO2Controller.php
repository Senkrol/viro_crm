<?php

namespace App\Http\Controllers\Admin\Statistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Statistics\StatisticsReportOO2;

class StatisticReportOO2Controller extends Controller
{
  public function index()
  {
    return inertia('Admin/Statistics/Reports/OO2/Report');
  }

  public function edit(Request $request)
  {
    $admin = Auth::user();

    $report = StatisticsReportOO2::where('year', '=', date('Y'))->where('organization_id', '=', $admin->organization_id)->first();


    return inertia('Admin/Statistics/Reports/OO2/Report', ['step' => $request->step, 'report' => $report]);
  }

  public function stepsValidate($step, $text)
  {
    return redirect()->route('admin.statistics.report.oo2.edit', ['step' => $step])->with('errorSpot', $text);
  }

  public function step1(Request $request)
  {
    $cells = []; //для удобной работы с проверками. 
    foreach ($request->editableCells as $r) {
      $cells[$r['cell']] = $r['val'];
    }
    //3
    if ($cells['1_3'] < $cells['1_4']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 01 графа 03 не соответствует Раздел 1.1 строка 01 графа 04');
    }
    //4
    if ($cells['2_3'] < $cells['2_4']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 02 графа 03 не соответствует Раздел 1.1 строка 02 графа 04');
    }
    //5
    if ($cells['1_7'] != 0 && $cells['1_8'] != 0) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 01 графа 07 не соответствует Раздел 1.1 строка 01 графа 08');
    }
    //6
    if ($cells['2_7'] != 0 && $cells['2_8'] != 0) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 02 графа 07 не соответствует Раздел 1.1 строка 02 графа 08');
    }
    //7
    if ($cells['1_16'] < ($cells['1_17'] + $cells['1_18'] + $cells['1_19'] + $cells['1_20'] + $cells['1_21'] + $cells['1_22'] + $cells['1_23'] + $cells['1_24'])) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 01 графа 16 не соответствует Раздел 1.1 строка 01 графа 17-24');
    }
    //8
    if ($cells['2_16'] < ($cells['2_17'] + $cells['2_18'] + $cells['2_19'] + $cells['2_20'] + $cells['2_21'] + $cells['2_22'] + $cells['2_23'] + $cells['2_24'])) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 02 графа 16 не соответствует Раздел 1.1 строка 02 графа 17-24');
    }
    //9
    if ($cells['1_16'] < $cells['1_3']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 3');
    }
    //10
    if ($cells['1_16'] < $cells['1_4']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 4');
    }
    //11
    if ($cells['1_16'] < $cells['1_5']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 5');
    }
    //12
    if ($cells['1_16'] < $cells['1_6']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 6');
    }
    //13
    if ($cells['1_16'] < $cells['1_7']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 7');
    }
    //14
    if ($cells['1_16'] < $cells['1_8']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 8');
    }
    //15
    if ($cells['1_16'] < $cells['1_9']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 9');
    }
    //16
    if ($cells['1_16'] < $cells['1_10']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 10');
    }
    //17
    if ($cells['1_16'] < $cells['1_11']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 11');
    }
    //18
    if ($cells['1_16'] < $cells['1_12']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 12');
    }
    //19
    if ($cells['1_16'] < $cells['1_13']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 13');
    }
    //20
    if ($cells['1_16'] < $cells['1_14']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 14');
    }
    //21
    if ($cells['1_16'] < $cells['1_15']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 1 графа 16 >= Раздел 1.1 строка 1 графа 15');
    }
    //22
    if ($cells['2_16'] < $cells['2_3']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 3');
    }
    //23
    if ($cells['2_16'] < $cells['2_4']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 4');
    }
    //24
    if ($cells['2_16'] < $cells['2_5']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 5');
    }
    //25
    if ($cells['2_16'] < $cells['2_6']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 6');
    }
    //26
    if ($cells['2_16'] < $cells['2_7']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 7');
    }
    //27
    if ($cells['2_16'] < $cells['2_8']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 8');
    }
    //28
    if ($cells['2_16'] < $cells['2_9']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 9');
    }
    //29
    if ($cells['2_16'] < $cells['2_10']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 10');
    }
    //30
    if ($cells['2_16'] < $cells['2_11']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 11');
    }
    //31
    if ($cells['2_16'] < $cells['2_12']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 12');
    }
    //32
    if ($cells['2_16'] < $cells['2_13']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 13');
    }
    //33
    if ($cells['2_16'] < $cells['2_14']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 14');
    }
    //34
    if ($cells['2_16'] < $cells['2_15']) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 2 графа 16 >= Раздел 1.1 строка 2 графа 15');
    }
    //35
    if ($cells['1_16'] < ($cells['1_7'] + $cells['1_8'])) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 01 графа 16 >= Раздел 1.1 строка 01 сумма граф 07 + 08');
    }
    //36
    if ($cells['2_16'] < ($cells['2_7'] + $cells['2_8'])) {
      return $this->stepsValidate(1, 'Раздел 1.1 строка 01 графа 16 >= Раздел 1.1 строка 01 сумма граф 07 + 08');
    }
    //37
    if (!$cells['3_3']) {
      return $this->stepsValidate(1, 'Не заполнена строка 3 графа 3 Раздела 1.1');
    }


    $admin = Auth::user();

    StatisticsReportOO2::updateOrCreate(
      ['organization_id' => $admin->organization_id, 'year' => date('Y')],
      ['step_1' => json_encode($request->editableCells)]
    );

    return redirect()->route('admin.statistics.report.oo2.edit', ['step' => '1'])->with('successSpot', 'Успешно');
    //return inertia('Admin/Statistics/Reports/OO2/Report', ['step' => "1"])->with('success', 'Добавлен региональный координатор!');

  }

  public function step2(Request $request)
  {

    $cells = []; //для удобной работы с проверками. 
    foreach ($request->editableCells as $r) {
      $cells[$r['cell']] = $r['val'];
    }

    for ($n = 1; $n <= 30; $n++) {
      if (!$cells[$n . '_3'] && $cells[$n . '_4']) { // если заполнен только 4й столбец
        return $this->stepsValidate(2, 'Раздел 1.1.1 графа 3 >= графа 4 по Зданию ' . $n);
      }

      if ($cells[$n . '_3'] && $cells[$n . '_4']) { //если оба атрибута заполнены 
        if ($cells[$n . '_3'] >= $cells[$n . '_4']) {
          return $this->stepsValidate(2, 'Раздел 1.1.1 графа 3 >= графа 4 по Зданию ' . $n);
        }
      }

      if ($cells[$n . '_3'] || $cells[$n . '_4']) { // если данные по зданию есть то должен быть указан материал
        if (1 != ($cells[$n . '_5'] + $cells[$n . '_6'] + $cells[$n . '_7'] + $cells[$n . '_8'] + $cells[$n . '_9'] + $cells[$n . '_10'] + $cells[$n . '_11'] + $cells[$n . '_12'])) {
          return $this->stepsValidate(2, 'Раздел 1.1.1 графа 03 не соответствует Раздел 1.1.1 сумма граф 05-12 по Зданию ' . $n);
        }
      }

      if (!$cells[$n . '_3'] && !$cells[$n . '_4']) { // если данных по зданию нет то не должно быть и данных по материалам
        if (0 < ($cells[$n . '_5'] + $cells[$n . '_6'] + $cells[$n . '_7'] + $cells[$n . '_8'] + $cells[$n . '_9'] + $cells[$n . '_10'] + $cells[$n . '_11'] + $cells[$n . '_12'])) {
          return $this->stepsValidate(2, 'Раздел 1.1.1 графа 03 не соответствует Раздел 1.1.1 сумма граф 05-12 по Зданию ' . $n);
        }
      }
    }

    $admin = Auth::user();

    StatisticsReportOO2::updateOrCreate(
      ['organization_id' => $admin->organization_id, 'year' => date('Y')],
      ['step_2' => json_encode($request->editableCells)]
    );

    return redirect()->route('admin.statistics.report.oo2.edit', ['step' => '2'])->with('successSpot', 'Успешно');
  }

  public function step3(Request $request)
  {

    $cells = []; //для удобной работы с проверками. 
    foreach ($request->editableCells as $r) {
      $cells[$r['cell']] = $r['val'];
    }

    for ($n = 1; $n <= 22; $n++) {
      if ($cells[$n . '_3'] < $cells[$n . '_4']) {
        return $this->stepsValidate(3, 'Раздел 1.2 строка 01 графа 03 >= Раздел 1.2 строка ' . $n . ' графа 04');
      }
    }

    if ($cells['23_3'] < $cells['24_3']) {
      return $this->stepsValidate(3, 'Раздел 1.2 строка 23 графа 03 >= Раздел 1.2 строка 24 графа 03');
    }
    if ($cells['23_3'] < $cells['25_3']) {
      return $this->stepsValidate(3, 'Раздел 1.2 строка 23 графа 03 >= Раздел 1.2 строка 25 графа 03');
    }
    if ($cells['5_3'] && $cells['26_3'] < 1) {
      return $this->stepsValidate(3, 'Раздел 1.2 строка 05 графа 03 не соответствует Раздел 1.2 строка 26 графа 03');
    }
    if (!$cells['5_3'] && $cells['26_3']) {
      return $this->stepsValidate(3, 'Раздел 1.2 строка 05 графа 03 не соответствует Раздел 1.2 строка 26 графа 03');
    }

    $admin = Auth::user();

    StatisticsReportOO2::updateOrCreate(
      ['organization_id' => $admin->organization_id, 'year' => date('Y')],
      ['step_3' => json_encode($request->editableCells)]
    );

    return redirect()->route('admin.statistics.report.oo2.edit', ['step' => '3'])->with('successSpot', 'Успешно');
  }

  public function step4(Request $request)
  {



    $cells = []; //для удобной работы с проверками. 
    foreach ($request->editableCells as $r) {
      $cells[$r['cell']] = $r['val'];
    }

    for ($n = 1; $n <= 3; $n++) {
      if ($cells[$n . '_3'] < $cells[$n . '_4']) {
        return $this->stepsValidate(4, 'Раздел 1.3 строка 01 графа 03 >= Раздел 1.3 строка ' . $n . ' графа 04');
      }
    }
    // 5 это машины а 6 это места
    if ($cells['5_3'] > $cells['6_3']) {
      return $this->stepsValidate(4, 'Раздел 1.3 строка 05 графа 03 не соответствует Раздел 1.3 строка 06 графа 03');
    }
    
    if (!$cells['5_3'] && $cells['6_3']) {
      return $this->stepsValidate(4, 'Раздел 1.3 строка 05 графа 03 не соответствует Раздел 1.3 строка 06 графа 03');
    }

    //for ($n = 1; $n <= 22; $n++) {}


    $admin = Auth::user();

    StatisticsReportOO2::updateOrCreate(
      ['organization_id' => $admin->organization_id, 'year' => date('Y')],
      ['step_4' => json_encode($request->editableCells)]
    );

    return redirect()->route('admin.statistics.report.oo2.edit', ['step' => '4'])->with('successSpot', 'Успешно');
  }
}
