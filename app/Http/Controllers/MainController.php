<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use App\Models\Week;

class MainController extends Controller
{
    public function index()
    {
        $week = Week::where('title', '1st Week')->first();
        $games = $week->games;

        return view('welcome', [
            'week' => $week,
            'games' => $games,
            'standings' => Standing::all()
        ]);
    }
}
