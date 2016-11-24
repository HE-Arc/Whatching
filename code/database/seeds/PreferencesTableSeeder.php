<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preferences')->insert([
          'user_id' => '1',
          'category_id' => '18',
          'movie_nbr' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('preferences')->insert([
          'user_id' => '2',
          'category_id' => '28',
          'movie_nbr' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);




    }
}
