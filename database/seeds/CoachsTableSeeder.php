<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CoachsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coachs')->insert([
            [
                'id' => 1,
                'club_id' => 1,                
                'firstname' => 'Olivier',
                'lastname' => 'Jurine',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email' => 'ojurine@gmail.com',
                'password' => bcrypt('password'),
                'active' => 1,
                
            ],
            [
                'id' => 2,
                'club_id' => 1,
                'firstname' => 'Stéphane',
                'lastname' => 'Gagnaire',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email' => 'sgagnaire@gmail.com',
                'password' => bcrypt('password'),
                'active' => 1,
            ],
            [
                'id' => 3,
                'club_id' => 1,
                'firstname' => 'Grégory',
                'lastname' => 'Liabeuf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email' => 'gliabeuf@gmail.com',
                'password' => bcrypt('password'),
               ' active' => 1,
            ],
            [
                'id' => 4,
                'club_id' => 1,
                'firstname' => 'Jordane',
                'lastname' => 'Carvalho',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email' => 'jcarvalho@gmail.com',
                'password' => bcrypt('password'),
                'active' => 1,
            ],
        ]);
    }
}
