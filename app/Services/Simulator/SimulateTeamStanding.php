<?php

namespace App\Services\Simulator;

use App\Enums\TeamGameOutcome;
use App\Models\Game;
use App\Models\Standing;
use App\Models\Team;

class SimulateTeamStanding
{
    public static function updateTeamStanding(Team $team, TeamGameOutcome $gameOutcome, int $goalDifference)
    {
        $standing = Standing::where('team_id', $team->id)->first();

        if($gameOutcome === TeamGameOutcome::WON) {
            $standing->won($goalDifference);
        }elseif ($gameOutcome === TeamGameOutcome::LOST) {
            $standing->lost($goalDifference);
        }else {
            $standing->draw();
        }

        $standing->save();
    }
}
