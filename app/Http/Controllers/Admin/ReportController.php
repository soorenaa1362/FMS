<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function dayIndex(){
        $dayIncomes = Income::whereBetween('date',[Carbon::now()->subDays(1),Carbon::now()])->get();

        return view('admin.reports.day.index');
    }

    public function dayIncomes(){
        dd("dayIncomes");
    }
}
