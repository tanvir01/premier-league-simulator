<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Prediction;
use App\Models\Standing;
use App\Models\Team;
use App\Models\Week;

class MainController extends Controller
{
    public function index()
    {
        $week = $this->determineWeek(0, 'asc', 'desc'); // unplayed or last week
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'standings' => $this->getLatestStandings(),
            'predictions' => $this->getPredictions()
        ]);
    }

    public function showResult()
    {
        $week = $this->determineWeek(1, 'desc', 'asc'); // played or first week
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'standings' => $this->getLatestStandings(),
            'predictions' => $this->getPredictions()
        ]);
    }

    private function getLatestStandings()
    {
        return (Standing::orderBy('points', 'desc')->orderBy('won', 'desc')->orderBy('goal_difference', 'desc')->get());
    }

    private function getPredictions()
    {
        return (Prediction::orderBy('percentage', 'desc')->get());
    }

    private function determineWeek(int $gameStatus, string $weekOrder, string $defaultWeekOrder): Week
    {
        $game = Game::where('status', $gameStatus)->orderBy('week_id', $weekOrder)->first();
        if($game) {
            return $game->week;
        }

        return (Week::orderBy('id', $defaultWeekOrder)->first());
    }
}
