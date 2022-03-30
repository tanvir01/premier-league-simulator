<?php

namespace App\Services\Simulator;

use App\Models\Game;
use App\Models\Week;
use App\Services\Predictor\PredictWinner;
use Illuminate\Database\Eloquent\Collection;

class SimulateGame
{
    public function simulateGamesForAllWeeks()
    {
        $weeks = Week::all();
        foreach ($weeks as $week){
            $this->simulateGamesForWeek($week);
        }
    }

    public function simulateGamesForWeek(Week $week)
    {
        foreach ($week->games as $game) {
            $this->simulateGame($game);
        }

        PredictWinner::updateTeamPredictions();
    }

    private function simulateGame(Game $game)
    {
        if($game->status === 1) {
            return;
        }

        $game->home_team_goal = SimulateTeamScore::generateTeamScore($game, $game->homeTeam);
        $game->away_team_goal = SimulateTeamScore::generateTeamScore($game, $game->awayTeam);
        $game->status = 1;
        $game->save();
    }
}
