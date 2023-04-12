<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $latestIncomes = Income::whereBetween('date',[Carbon::now()->subDays(1), Carbon::now()])->latest()->paginate(3);
        $latestCosts = Cost::whereBetween('date', [Carbon::now()->subDays(1), Carbon::now()])->latest()->paginate(3);

        return view('admin.dashboard', compact('latestIncomes', 'latestCosts'));
    }
}
