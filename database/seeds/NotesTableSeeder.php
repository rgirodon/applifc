<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            [
                'id' => 1,
                'club_id' => 1,
                'coach_id' => 3,
                'player_id' => 1,
                'title' => 'Observation Entrainement 11/04/2019',
                'content' => 'Bonne patte gauche',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'club_id' => 1,
                'coach_id' => 2,
                'player_id' => 2,
                'title' => 'Observation Entrainement 10/04/2019',
                'content' => 'Bon jeu de tête, mais doit travailler sa vitesse',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
