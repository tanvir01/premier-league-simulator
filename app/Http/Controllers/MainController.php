<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Standing;
use App\Models\Week;

class MainController extends Controller
{
    public function index(Week $week = null)
    {
        if(!$week) {
            $week = Week::first();
        }
        $games = $week->games;
        $isLastWeek = $this->checkIfLastWeek($week);

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'isLastWeek' => $isLastWeek,
            'standings' => Standing::orderBy('points', 'desc')->orderBy('won', 'desc')->orderBy('goal_difference', 'desc')->get()
        ]);
    }

    private function checkIfLastWeek(Week $week)
    {
        return $week->is(Week::orderBy('id', 'desc')->first());
    }
}
