<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClubsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(LicencesTableSeeder::class);
        $this->call(CoachsTableSeeder::class);
        $this->call(InvitationsTableSeeder::class);
        $this->call(InscriptionsTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
    }
}
