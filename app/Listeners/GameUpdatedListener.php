<?php

namespace App\Listeners;

use App\Enums\TeamGameOutcome;
use App\Events\GameUpdated;
use App\Models\Game;
use App\Models\Team;
use App\Services\Simulator\SimulateTeamStanding;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GameUpdatedListener
{
    private TeamGameOutcome $homeTeamOutcome;
    private TeamGameOutcome $awayTeamOutcome;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->homeTeamOutcome = TeamGameOutcome::WON;
        $this->awayTeamOutcome = TeamGameOutcome::LOST;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\GameUpdated  $event
     * @return void
     */
    public function handle(GameUpdated $event)
    {
        /* @var Game */
        $game = $event->game;

        if($game->status == 1){
            $homeTeamGoalDifference = $game->home_team_goal - $game->away_team_goal;
            $this->updateTeamGameOutcomes($homeTeamGoalDifference);

            $goalDifference = abs($homeTeamGoalDifference);
            SimulateTeamStanding::updateTeamStanding($game->homeTeam, $this->homeTeamOutcome, $goalDifference);
            SimulateTeamStanding::updateTeamStanding($game->awayTeam, $this->awayTeamOutcome, $goalDifference);
        }
    }

    private function updateTeamGameOutcomes(int $homeTeamGoalDifference)
    {
        if($homeTeamGoalDifference === 0) {
            $this->homeTeamOutcome = TeamGameOutcome::DRAW;
            $this->awayTeamOutcome = TeamGameOutcome::DRAW;
        }elseif ($homeTeamGoalDifference < 0) {
            $this->homeTeamOutcome = TeamGameOutcome::LOST;
            $this->awayTeamOutcome = TeamGameOutcome::WON;
        }
    }
}
