<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Cards
Route::resource('cards', CardController::class);
Route::get('cards/{card_id}/action', [CardController::class, 'action'])->name('cards.action');
Route::get('cards/{card_id}/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
Route::post('cards/{card_id}/incomes', [IncomeController::class, 'store'])->name('incomes.store');
Route::get('cards/{card_id}/costs/create', [CostController::class, 'create'])->name('costs.create');
Route::post('cards/{card_id}/costs', [CostController::class, 'store'])->name('costs.store');


// Incomes
Route::get('incomes', [IncomeController::class, 'index'])->name('incomes.index');
Route::get('incomes/{income_id}', [IncomeController::class, 'show'])->name('incomes.show');
Route::get('incomes/{income_id}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
Route::put('incomes/{card_id}', [IncomeController::class, 'update'])->name('incomes.update');
Route::get('incomes/cards/select', [IncomeController::class, 'add'])->name('incomes.add');


// List Of A Card's Incomes (Today-Week-Month)
Route::get('cards/{card_id}/incomes/today', [IncomeController::class, 'today'])->name('incomes.today');
Route::get('cards/{card_id}/incomes/week', [IncomeController::class, 'week'])->name('incomes.week');
Route::get('cards/{card_id}/incomes/month', [IncomeController::class, 'month'])->name('incomes.month');


// Costs
Route::get('costs', [CostController::class, 'index'])->name('costs.index');
Route::get('costs/{cost_id}', [CostController::class, 'show'])->name('costs.show');
Route::get('costs/{cost_id}/edit', [CostController::class, 'edit'])->name('costs.edit');
Route::put('costs/{card_id}', [CostController::class, 'update'])->name('costs.update');
Route::get('costs/cards/select', [CostController::class, 'add'])->name('costs.add');


// List Of A Card's Costs (Today-Week-Month)
Route::get('cards/{card_id}/costs/today', [CostController::class, 'today'])->name('costs.today');
Route::get('cards/{card_id}/costs/week', [CostController::class, 'week'])->name('costs.week');
Route::get('cards/{card_id}/costs/month', [CostController::class, 'month'])->name('costs.month');


// Reports : incomes
Route::get('report/today/incomes', [ReportController::class, 'todayIncomes'])->name('report.today.incomes');
Route::get('report/week/incomes', [ReportController::class, 'weekIncomes'])->name('report.week.incomes');
Route::get('report/month/incomes', [ReportController::class, 'monthIncomes'])->name('report.month.incomes');

// Reports : costs
Route::get('report/today/costs', [ReportController::class, 'todayCosts'])->name('report.today.costs');
Route::get('report/week/costs', [ReportController::class, 'weekCosts'])->name('report.week.costs');
Route::get('report/month/costs', [ReportController::class, 'monthCosts'])->name('report.month.costs');



































