<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\Income;
use App\Models\Cost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::all();

        // foreach($cards as $card){
        //     $c = 0;
        //     $cash = $card->cash + $c;
        // }

        return view('admin.cards.index' , compact('cards'));
    }



    public function create()
    {
        return view('admin.cards.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alias' => 'nullable',
            'number' => 'nullable|numeric',
            'cash' => 'required|numeric',
        ]);

        Card::create([
            'name' => $request->name,
            'alias' => $request->alias,
            'number' => $request->number,
            'first_cash' => $request->cash,
            'cash' => $request->cash,
        ]);

        alert()->success('کارت مورد نظر ثبت شد .', 'انجام شد');
        return redirect()->route('cards.index');
    }



    public function show(Card $card)
    {
        // $cardCreatedAt = Jalalian::fromDateTime($card->created_at)->format('Y/m/d');
        // dd($cardCreatedAt);

        $incomes = Income::where('card_id', $card->id)->get();
        $costs = Cost::where('card_id', $card->id)->get();

        return view('admin.cards.show', compact('card', 'incomes', 'costs'));
    }



    public function edit(Card $card)
    {
        $incomes = Income::where('card_id', $card->id)->get();
        return view('admin.cards.edit' , compact('card', 'incomes'));
    }



    public function update(Request $request, Card $card)
    {
        $request->validate([
            'name' => 'required',
            'alias' => 'nullable',
            'number' => 'nullable|numeric',
            'cash' => 'required|numeric',
        ]);

        $card->update([
            'name' => $request->name,
            'alias' => $request->alias,
            'number' => $request->number,
            'first_cash' => $request->cash,
            'cash' => $request->cash,
        ]);

        alert()->success('کارت بانکی مورد نظر بروز رسانی شد.', 'انجام شد');
        return redirect()->route('cards.index');
    }



    public function action($card_id)
    {
        $card = Card::where('id', $card_id)->first();

        return view('admin.cards.action', compact('card'));
    }
}
