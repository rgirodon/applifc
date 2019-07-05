<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
            'id' => 1,
            'name' => 'Côte-Chaude Sportif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'server' => 'ccs',
        ]);
    }
}