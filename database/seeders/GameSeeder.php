<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Week;
use App\Services\Fixture\FixtureDraw;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::all();
        $weeks = Week::all();
        $fixtureDrawService = new FixtureDraw($teams, $weeks);

        DB::transaction(function() use ($fixtureDrawService) {
            $fixtureDrawService->generateAllFixtures();
        });
    }
}
