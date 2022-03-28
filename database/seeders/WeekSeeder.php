<?php

namespace Database\Seeders;

use App\Models\Week;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            Week::insert([
                ['title' => '1st Week'],
                ['title' => '2nd Week'],
                ['title' => '3rd Week'],
                ['title' => '4th Week'],
                ['title' => '5th Week'],
                ['title' => '6th Week'],
            ]);
        });
    }
}
