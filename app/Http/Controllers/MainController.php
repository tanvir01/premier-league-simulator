<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Standing;
use App\Models\Week;

class MainController extends Controller
{
    public function index()
    {
        $week = Week::first();
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'standings' => Standing::orderBy('points', 'desc')->orderBy('won', 'desc')->orderBy('goal_difference', 'desc')->get()
        ]);
    }

    public function showNextWeek()
    {
        $week = Game::where('status',0)->orderby('week_id', 'asc')->first()->week;
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'standings' => Standing::orderBy('points', 'desc')->orderBy('won', 'desc')->orderBy('goal_difference', 'desc')->get()
        ]);
    }
}
