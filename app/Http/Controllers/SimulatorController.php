<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Prediction;
use App\Models\Standing;
use App\Models\Week;
use App\Services\Simulator\SimulateGame;

class SimulatorController extends Controller
{
    private SimulateGame $simulateGame;

    public function __construct(SimulateGame $simulateGame)
    {
        $this->simulateGame = $simulateGame;
    }

    public function simulateWeek(Week $week)
    {
        $this->simulateGame->simulateGamesForWeek($week);

        return redirect('/show-result');
    }

    public function simulateAll()
    {
        $this->simulateGame->simulateGamesForAllWeeks();

        return redirect('/show-result');
    }

    public function simulateReset()
    {
        $games = Game::all();
        $standings = Standing::all();
        $predictions = Prediction::all();

        foreach ($games as $game) {
            $game->resetGame();
            $game->save();
        }
        foreach ($standings as $standing) {
            $standing->resetStanding();
            $standing->save();
        }
        foreach ($predictions as $prediction) {
            $prediction->resetPrediction();
            $prediction->save();
        }

        return redirect('/');
    }
}
