<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function todayIncomes()
    {
        $todayIncomes = Income::whereBetween('date',[Carbon::now()->subDays(1), Carbon::now()])->latest()->paginate(10);

        return view('admin.reports.incomes.today.index', compact('todayIncomes'));
    }



    public function weekIncomes()
    {
        $weekIncomes = Income::whereBetween('date',[Carbon::now()->subDays(7), Carbon::now()])->latest()->paginate(10);

        return view('admin.reports.incomes.week.index', compact('weekIncomes'));
    }


    public function monthIncomes()
    {
        $monthIncomes = Income::whereBetween('date',[Carbon::now()->subDays(30), Carbon::now()])->latest()->paginate(10);

        return view('admin.reports.incomes.month.index', compact('monthIncomes'));
    }


    public function todayCosts()
    {
        $todayCosts = Cost::whereBetween('date',[Carbon::now()->subDays(1), Carbon::now()])->latest()->paginate(10);

        return view('admin.reports.costs.today.index', compact('todayCosts'));
    }



    public function weekCosts()
    {
        $weekCosts = Cost::whereBetween('date',[Carbon::now()->subDays(7), Carbon::now()])->latest()->paginate(10);

        return view('admin.reports.costs.week.index', compact('weekCosts'));
    }


    public function monthCosts()
    {
        $monthCosts = Cost::whereBetween('date',[Carbon::now()->subDays(30), Carbon::now()])->latest()->paginate(10);

        return view('admin.reports.costs.month.index', compact('monthCosts'));
    }
}
