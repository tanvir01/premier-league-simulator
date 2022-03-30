<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Prediction;
use App\Models\Standing;
use App\Models\Week;
use App\Services\Simulator\SimulateGame;
use App\Services\Simulator\SimulateReset;

class SimulatorController extends Controller
{
    private SimulateGame $simulateGame;

    public function __construct(SimulateGame $simulateGame)
    {
        $this->simulateGame = $simulateGame;
    }

    public function simulateWeek(Week $week)
    {
        $this->simulateGame->simulateGamesForWeek($week);

        return redirect('/show-result');
    }

    public function simulateAll()
    {
        $this->simulateGame->simulateGamesForAllWeeks();

        return redirect('/show-result');
    }

    public function simulateReset()
    {
        SimulateReset::resetAll();

        return redirect('/');
    }
}
