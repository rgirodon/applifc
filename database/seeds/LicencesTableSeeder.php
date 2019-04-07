<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LicencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licences')->insert([
            [
                'id' => 1,
                'club_id' => 1,
                'category_id' => 8,
                'player_id' => 1,
                'starts_at' => Carbon::createMidnightDate(2018, 9, 1),
                'ends_at' => Carbon::createMidnightDate(2019, 6, 30),
                'paid' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'club_id' => 1,
                'category_id' => 7,
                'player_id' => 2,
                'starts_at' => Carbon::createMidnightDate(2018, 9, 1),
                'ends_at' => Carbon::createMidnightDate(2019, 6, 30),
                'paid' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'club_id' => 1,
                'category_id' => 8,
                'player_id' => 3,
                'starts_at' => Carbon::createMidnightDate(2018, 9, 1),
                'ends_at' => Carbon::createMidnightDate(2019, 6, 30),
                'paid' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'club_id' => 1,
                'category_id' => 7,
                'player_id' => 4,
                'starts_at' => Carbon::createMidnightDate(2018, 9, 1),
                'ends_at' => Carbon::createMidnightDate(2019, 6, 30),
                'paid' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
