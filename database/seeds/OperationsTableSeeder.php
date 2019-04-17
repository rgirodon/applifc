<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operations')->insert([
            [
                'label' => 'Loto 2019', 
                'club_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Calendriers 2019', 
                'club_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]            
        ]);
    }
}
