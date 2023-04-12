<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Cost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CostController extends Controller
{
    public function index()
    {
        $cards = Card::all();
        $costs = Cost::all();

        return view('admin.costs.index', compact('cards', 'costs'));
    }



    public function create($card_id)
    {
        $card = Card::where('id', $card_id)->first();

        return view('admin.costs.create', compact('card'));
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

        $cost = new Cost;
        $cost->title = $request->title;
        $cost->date = convertShamsiToGregorianDate($request->date);
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        $cost->card_id = $card_id;
        if($cost->amount > $card->cash){
            // alert()->success('مبلغ وارد شده از موجودی حساب بیشتر است .', 'انجام نشد');
            return redirect()->back();
        }else{
            $cost->save();
        }

        $newCash = $card->cash - $cost->amount;

        $card->update([
            'cash' => $newCash
        ]);

        alert()->success('تراکنش مورد نظر ثبت شد .', 'انجام شد');
        return redirect()->route('costs.index');
    }



    public function show($cost_id)
    {
        $cost = Cost::where('id', $cost_id)->first();
        $cardId = $cost->card_id;
        $card = Card::where('id', $cardId)->first();

        return view('admin.costs.show', compact('cost', 'card'));
    }



    public function edit($cost_id)
    {
        $cost = Cost::where('id', $cost_id)->first();
        $cards = Card::all();

        return view('admin.costs.edit', compact('cost', 'cards'));
    }



    public function update(Request $request, $cost_id)
    {
        $cost = Cost::where('id', $cost_id)->first();

        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'card_id' => 'required',
        ]);

        $cost->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => convertShamsiToGregorianDate($request->date),
            'card_id' => $request->card_id,
        ]);

        alert()->success('تراکنش مورد نظر بروزرسانی شد .', 'انجام شد');
        return redirect()->route('costs.index');
    }


    public function destroy(Cost $cost)
    {

    }


    public function add()
    {
        $cards = Card::all();

        return view('admin.costs.cards', compact('cards'));
    }


    public function today($card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $costs = Cost::where('card_id', $card_id)->whereBetween('date',[Carbon::now()->subDays(1),Carbon::now()])->get();

        $cash = 0;
        foreach ($costs as $cost) {
            $cash -= $cost->amount;
        }

        return view('admin.cards.costs.today', compact('cash', 'card', 'costs'));
    }


    public function week($card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $costs = Cost::where('card_id', $card_id)->whereBetween('date',[Carbon::now()->subDays(7),Carbon::now()])->get();

        $cash = 0;
        foreach ($costs as $cost) {
            $cash -= $cost->amount;
        }

        return view('admin.cards.costs.week', compact('cash', 'card', 'costs'));
    }


    public function month($card_id)
    {
        $card = Card::where('id', $card_id)->first();
        $costs = Cost::where('card_id', $card_id)->whereBetween('date',[Carbon::now()->subDays(30),Carbon::now()])->get();

        $cash = 0;
        foreach ($costs as $cost) {
            $cash -= $cost->amount;
        }

        return view('admin.cards.costs.month', compact('cash', 'card', 'costs'));
    }
}
