<?php

namespace App\Http\Controllers;

use App\Models\Week;

class SimulatorController extends Controller
{
    public function simulateWeek(Week $week)
    {
        dump($week);
        die;
    }

    public function simulateAll()
    {
        dump("all");
        die;
    }

    public function simulateReset()
    {
        dump("reset");
        die;
    }
}
