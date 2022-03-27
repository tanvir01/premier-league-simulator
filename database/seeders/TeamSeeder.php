<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            Team::insert([
                ['name' => 'Chelsea', 'power' => 70, 'supporter_strength' => 80, 'goalkeeper_strength' => 80],
                ['name' => 'Arsenal', 'power' => 50, 'supporter_strength' => 70, 'goalkeeper_strength' => 40],
                ['name' => 'ManCity', 'power' => 100, 'supporter_strength' => 100, 'goalkeeper_strength' => 100],
                ['name' => 'Liverpool', 'power' => 90, 'supporter_strength' => 90, 'goalkeeper_strength' => 60],
            ]);
        });
    }
}
