<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'label' => 'U6', 
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2013, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2013, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U7', 
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2012, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2012, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U8',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2011, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2011, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U9',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2010, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2010, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U10',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2009, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2009, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U11',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2008, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2008, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U12',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2007, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2007, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U13',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2006, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2006, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U14',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2005, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2005, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U15',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2004, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2004, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U16',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2003, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2003, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U17',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2002, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2002, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U18',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2001, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2001, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'U19',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => Carbon::createMidnightDate(2000, 1, 1),
                'ends_at' => Carbon::createMidnightDate(2000, 12, 31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Senior',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Foot Loisir',
                'club_id' => 1,
                'sex' => 'h',
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
