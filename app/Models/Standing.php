<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function won($goalDifference)
    {
        $this->played += 1;
        $this->won += 1;
        $this->points += 3;
        $this->goal_difference += $goalDifference;
    }

    public function lost($goalDifference)
    {
        $this->played += 1;
        $this->loss += 1;
        $this->goal_difference -= $goalDifference;
    }

    public function draw()
    {
        $this->played += 1;
        $this->draw += 1;
        $this->points += 1;
    }

    public function resetStanding()
    {
        $this->played = 0;
        $this->won = 0;
        $this->draw = 0;
        $this->loss = 0;
        $this->goal_difference = 0;
        $this->points = 0;
    }
}
