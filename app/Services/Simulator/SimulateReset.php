<?php

namespace App\Services\Simulator;

use App\Models\Game;
use App\Models\Prediction;
use App\Models\Standing;

class SimulateReset
{
    public static function resetAll()
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
    }
}
