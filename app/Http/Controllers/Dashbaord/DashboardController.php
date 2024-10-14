<?php

namespace App\Http\Controllers\Dashbaord;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //--dashboard
    public function dashboard()
    {
        $games = Game::take(10)->get();
        return view('dashboard.dashboard', compact('games'));
    }
   
}
