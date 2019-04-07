<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            [
                'id' => 1,
                'club_id' => 1,                
                'firstname' => 'Adam',
                'lastname' => 'Ait Lho',
                'birth' => Carbon::createMidnightDate(2008, 4, 27),
                'sex' => 'h',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'club_id' => 1,
                'firstname' => 'Zakaria',
                'lastname' => 'Touimi',
                'birth' => Carbon::createMidnightDate(2009, 6, 7),
                'sex' => 'h',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'club_id' => 1,
                'firstname' => 'Mitat Emin',
                'lastname' => 'Caner',
                'birth' => Carbon::createMidnightDate(2008, 8, 26),
                'sex' => 'h',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'club_id' => 1,
                'firstname' => 'Mehdi',
                'lastname' => 'Debbah',
                'birth' => Carbon::createMidnightDate(2009, 7, 7),
                'sex' => 'h',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
