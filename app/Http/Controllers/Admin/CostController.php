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
        $cardCreatedAt = verta($card->created_at)->format('Y/m/d');

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

        if( verta($cost->date)->format('Y/m/d') >= $cardCreatedAt && verta($cost->date) <= verta(now()) ){
            if( $cost->amount <= $card->cash ){
                $cost->save();
                $newCash = $card->cash - $cost->amount;

                $card->update([
                    'cash' => $newCash
                ]);

                alert()->success('تراکنش مورد نظر ثبت شد .', 'انجام شد.');
                return redirect()->route('costs.index');
            }else{
                alert()->error('مبلغ نباید بیشتر از موجودی حساب باشد .', 'مبلغ درست نیست.');
                return redirect()->back();
            }
        }else{
            alert()->error('تاریخ تراکنش نباید قبل از تاریخ ثبت کارت و یا بعد از امروز باشد .', 'تاریخ بدرستی وارد نشده است');
            return redirect()->back();
        }

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
        $oldCostAmount = $cost->amount;
        $card = Card::where('id', $cost->card_id)->first();
        $cardCreatedAt = verta($card->created_at)->format('Y/m/d');

        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'card_id' => 'required',
        ]);

        $cost->title = $request->title;
        $cost->date = convertShamsiToGregorianDate($request->date);
        $cost->amount = $request->amount;
        $cost->card_id = $request->card_id;

        $newCard = Card::find($cost->card_id);

        if( verta($cost->date)->format('Y/m/d') <= $cardCreatedAt && verta($cost->date)->format('Y/m/d') >= verta(now()) ){

            if($card == $newCard){

                $cost->update();
                $newCash = ($card->cash + $oldCostAmount) - $cost->amount;
                $card->update([
                    'cash' => $newCash
                ]);

            }else{

                if( $cost->amount <= $newCard->cash ){

                    $cost->update();
                    $oldCash = ($card->cash + $oldCostAmount);
                    $card->update([
                        'cash' => $oldCash
                    ]);

                    $newCash = $newCard->cash - $cost->amount;
                    $newCard->update([
                        'cash' => $newCash
                    ]);

                }else{

                    alert()->error('مبلغ نباید بیشتر از موجودی حساب باشد .', 'مبلغ درست نیست.');
                    return redirect()->back();

                }

            }

        }else{

            alert()->error('تاریخ تراکنش نباید قبل از تاریخ ثبت کارت و یا بعد از امروز باشد .', 'تاریخ بدرستی وارد نشده است');
            return redirect()->back();

        }
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
