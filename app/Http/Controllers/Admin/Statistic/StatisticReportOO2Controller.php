<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticReportOO2Controller extends Controller
{
  public function index()
  {
    return inertia('Admin/Statistics/ReportOO2');
  }
}
