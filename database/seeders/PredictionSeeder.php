<?php

namespace Database\Seeders;

use App\Models\Prediction;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $initialPredictions = [];
        $teamIds = Team::pluck('id');

        foreach ($teamIds as $teamId) {
            $data = [
                'team_id'    => $teamId,
                'percentage'     => 0,
            ];
            $initialPredictions[] = $data;
        }

        DB::transaction(function() use ($initialPredictions) {
            Prediction::insert($initialPredictions);
        });
    }
}
