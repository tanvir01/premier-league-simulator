<?php

namespace App\Services\Fixture;

use App\Models\Game;
use App\Models\Week;
use Illuminate\Database\Eloquent\Collection;

class FixtureDraw
{
    private Collection $teams;
    private Collection $weeks;

    public function __construct(Collection $teams, Collection $weeks)
    {
        $this->teams = $teams->shuffle();
        $this->weeks = $weeks;
    }

    public function generateAllFixtures()
    {
        foreach ($this->weeks as $week) {
            $this->generateFixtureForWeek($week);
        }
    }

    private function generateFixtureForWeek(Week $week)
    {
        //TODO: check for exception such as team count is not 4

        if($this->isSameFixtureExisting()){
            $this->teams = $this->teams->shuffle();

            return $this->generateFixtureForWeek($week);
        }

        // create 2 games for the week
        Game::create([
            'home_team_id' => $this->teams[0]->id,
            'away_team_id' => $this->teams[1]->id,
            'week_id' => $week->id
        ]);
        Game::create([
            'home_team_id' => $this->teams[2]->id,
            'away_team_id' => $this->teams[3]->id,
            'week_id' => $week->id
        ]);
    }

    private function isSameFixtureExisting(): bool
    {
        return ((Game::where('home_team_id', $this->teams[0]->id)
                ->where('away_team_id', $this->teams[1]->id)
                ->first())||
                (Game::where('home_team_id', $this->teams[2]->id)
                ->where('away_team_id', $this->teams[3]->id)
                ->first()));
    }
}
