<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    public function index()
    {
        $cards = Card::all();
        $incomes = Income::all();

        return view('admin.incomes.index', compact('cards', 'incomes'));
    }



    public function create($card_id)
    {
        $card = Card::where('id', $card_id)->first();

        return view('admin.incomes.create', compact('card'));
    }



    public function store(Request $request, $card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $cardCreatedAt = convertShamsiToGregorianDate($card->created_at);

        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'description' => 'nullable',
        ]);

        $income = new Income;
        $income->title = $request->title;
        $income->date = convertShamsiToGregorianDate($request->date);
        $income->amount = $request->amount;
        $income->description = $request->description;
        $income->card_id = $card_id;
        $income->save();

        $newCash = $card->cash + $income->amount;

        $card->update([
            'cash' => $newCash
        ]);


        alert()->success('تراکنش مورد نظر ثبت شد .', 'انجام شد');
        return redirect()->route('incomes.index');
    }



    public function show($income_id)
    {
        $income = Income::where('id', $income_id)->first();
        $cardId = $income->card_id;
        $card = Card::where('id', $cardId)->first();

        return view('admin.incomes.show', compact('income', 'card'));
    }



    public function edit($income_id)
    {
        $income = Income::where('id', $income_id)->first();
        $cards = Card::all();

        return view('admin.incomes.edit', compact('income', 'cards'));
    }



    public function update(Request $request, $income_id)
    {
        $income = Income::where('id', $income_id)->first();

        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'card_id' => 'required',
        ]);

        $income->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => convertShamsiToGregorianDate($request->date),
            'card_id' => $request->card_id,
        ]);

        alert()->success('تراکنش مورد نظر بروزرسانی شد .', 'انجام شد');
        return redirect()->route('incomes.index');
    }


    public function destroy(Income $income)
    {

    }


    public function add()
    {
        $cards = Card::all();

        return view('admin.incomes.cards', compact('cards'));
    }


    public function today($card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $incomes = Income::where('card_id', $card_id)->whereBetween('date',[Carbon::now()->subDays(1),Carbon::now()])->get();

        $cash = 0;
        foreach ($incomes as $income) {
            $cash += $income->amount;
        }

        return view('admin.cards.incomes.today', compact('cash', 'card', 'incomes'));
    }


    public function week($card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $incomes = Income::where('card_id', $card_id)->whereBetween('date',[Carbon::now()->subDays(7),Carbon::now()])->get();

        $cash = 0;
        foreach ($incomes as $income) {
            $cash += $income->amount;
        }

        return view('admin.cards.incomes.week', compact('cash', 'card', 'incomes'));
    }


    public function month($card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $incomes = Income::where('card_id', $card_id)->whereBetween('date',[Carbon::now()->subDays(30),Carbon::now()])->get();

        $cash = 0;
        foreach ($incomes as $income) {
            $cash += $income->amount;
        }

        return view('admin.cards.incomes.month', compact('cash', 'card', 'incomes'));
    }
}
