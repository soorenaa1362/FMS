<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;

class TestController extends Controller
{
    public function index()
    {
        echo now()->toJalali();
    }
}
