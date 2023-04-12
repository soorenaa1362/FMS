<?php

namespace App\Http\Controllers\Home;

use App\Models\Card;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $cards = Card::all();

        if(blank($cards)){
            return view('admin.home');
        }else{
            return redirect()->route('costs.add');
        }
    }
}
