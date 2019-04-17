<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invitations')->insert([
            [
                'id' => 1,
                'club_id' => 1,
                'libelle' => 'Tournoi U11 St-Victor-sur-Loire',                
                'date_competition' => Carbon::createMidnightDate(2019, 5, 4),
                'date_limite_reponse' => Carbon::createMidnightDate(2019, 3, 4),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        
        DB::table('invitations_categories')->insert([
            [
                'id' => 1,
                'category_id' => 7,
                'invitation_id' => 1
            ],
            [
                'id' => 2,
                'category_id' => 8,
                'invitation_id' => 1
            ],
        ]);
    }
}
