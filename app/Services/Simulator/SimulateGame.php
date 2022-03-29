<?php

namespace App\Services\Simulator;

use App\Models\Game;
use App\Models\Week;
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
    }

    private function simulateGame(Game $game)
    {
        $game->home_team_goal = SimulateTeamScore::generateTeamScore($game, $game->homeTeam);
        $game->away_team_goal = SimulateTeamScore::generateTeamScore($game, $game->awayTeam);
        $game->status = 1;
        $game->save();
    }
}
