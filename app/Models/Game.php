<?php

namespace App\Models;

use App\Events\GameUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => GameUpdated::class,
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }

    public function resetGame()
    {
        $this->home_team_goal = 0;
        $this->away_team_goal = 0;
        $this->status = 0;
    }
}
