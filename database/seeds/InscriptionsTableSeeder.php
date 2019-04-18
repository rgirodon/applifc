<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inscriptions')->insert([
            [
                'id' => 1,
                'club_id' => 1,
                'libelle' => 'Tournoi U11 St-Victor-sur-Loire',
                'date_competition' => Carbon::createMidnightDate(2019, 5, 4),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        
        DB::table('inscriptions_categories')->insert([
            [
                'id' => 1,
                'category_id' => 7,
                'inscription_id' => 1
            ],
            [
                'id' => 2,
                'category_id' => 8,
                'inscription_id' => 1
            ],
        ]);
    }
}
