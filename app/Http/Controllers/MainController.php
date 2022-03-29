<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Standing;
use App\Models\Week;

class MainController extends Controller
{
    public function index()
    {
        $week = $this->determineLastUnplayedWeek();
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'isLastWeek' => $this->checkIfLastWeek($week),
            'standings' => $this->getLastStandings()
        ]);
    }

    public function showResult()
    {
        $week = $this->determineLastPlayedWeek();
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'isLastWeek' => $this->checkIfLastWeek($week),
            'standings' => $this->getLastStandings()
        ]);
    }

    private function determineLastUnplayedWeek(): Week
    {
        $gameForNextUnplayedWeek = Game::where('status', 0)->orderBy('week_id', 'asc')->first();
        if($gameForNextUnplayedWeek) {
            return $gameForNextUnplayedWeek->week;
        }

        return (Week::orderBy('id', 'desc')->first());
    }

    private function checkIfLastWeek(Week $week): bool
    {
        return $week->is(Week::orderBy('id', 'desc')->first());
    }

    private function getLastStandings()
    {
        return (Standing::orderBy('points', 'desc')->orderBy('won', 'desc')->orderBy('goal_difference', 'desc')->get());
    }

    private function determineLastPlayedWeek()
    {
        return Game::where('status', 1)->orderBy('week_id', 'desc')->first()->week;
    }
}
