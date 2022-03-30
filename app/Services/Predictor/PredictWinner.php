<?php

namespace App\Services\Predictor;

use App\Models\Prediction;
use App\Models\Standing;

class PredictWinner
{
    public static function updateTeamPredictions()
    {
        $standings = Standing::all();
        $totalCurrentStandingPoints = $standings->sum('points');
        $teamStandings = $standings->pluck('points', 'team_id');

        $teamPredictions = [];
        foreach ($teamStandings as $teamId => $teamPoints) {
            $teamPredictions[$teamId] = round(($teamPoints / $totalCurrentStandingPoints) * 100);
        }

        // TODO: check total percentage calculated for all teams adds to 100, adjust if necessary

        $predictions = Prediction::all();
        foreach ($predictions as $prediction){
            $prediction->percentage = $teamPredictions[$prediction->team_id];
            $prediction->save();
        }
    }
}
