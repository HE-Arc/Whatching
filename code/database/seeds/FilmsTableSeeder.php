<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
          'filmTMDB_id' => '550',
          'name' => 'Fight Club'
        ]);

        DB::table('films')->insert([
          'filmTMDB_id' => '68735',
          'name' => 'Warcraft'
        ]);

        DB::table('films')->insert([
          'filmTMDB_id' => '109445',
          'name' => 'Frozen'
        ]);


    }
}
