<?php

namespace Database\Seeders;

use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $initialStandings = [];
        $teamIds = Team::pluck('id');

        foreach ($teamIds as $teamId) {
            $data = [
                'team_id'    => $teamId,
                'played'     => 0,
                'won'        => 0,
                'loss'       => 0,
                'draw'       => 0,
                'goal_difference' => 0,
                'points'     => 0
            ];
            $initialStandings[] = $data;
        }

        DB::transaction(function() use ($initialStandings) {
            Standing::insert($initialStandings);
        });
    }
}
