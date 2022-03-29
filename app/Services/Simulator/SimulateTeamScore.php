<?php

namespace App\Services\Simulator;

use App\Models\Game;
use App\Models\Team;

final class SimulateTeamScore
{
    private const MAX_GOALS_POSSIBLE = 10;
    private const MAX_RANDOM_VALUE = 50;
    private const POWER_WEIGHT = 0.5;
    private const GOALKEEPER_STRENGTH_WEIGHT = 0.3;
    private const HOME_TEAM_SUPPORTER_STRENGTH_WEIGHT = 0.2;
    private const AWAY_TEAM_SUPPORTER_STRENGTH_WEIGHT = 0.1;
    private const STRENGTH_DENOMINATOR = 300; // max possible strength combo - 100 (power) + 100 (goalkeeper_strength) + 100 (supporter_strength) = 300

    public static function generateTeamScore(Game $game, Team $team): int
    {
        $supporterStrengthWeight = self::HOME_TEAM_SUPPORTER_STRENGTH_WEIGHT;
        if($game->awayTeam === $team) {
            $supporterStrengthWeight = self::AWAY_TEAM_SUPPORTER_STRENGTH_WEIGHT;
        }

        $teamTotal = ($team->power * self::POWER_WEIGHT
                    + $team->goalkeeper_strength * self::GOALKEEPER_STRENGTH_WEIGHT
                    + $team->supporter_strength * $supporterStrengthWeight)
                    + mt_rand(0,self::MAX_RANDOM_VALUE);

        return round(($teamTotal / self::STRENGTH_DENOMINATOR) * self::MAX_GOALS_POSSIBLE);
    }

}
