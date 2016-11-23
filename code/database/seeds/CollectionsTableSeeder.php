<?php

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collections')->insert([
          'user_id' => '1',
          'film_id' => '1'
        ]);

        DB::table('collections')->insert([
          'user_id' => '2',
          'film_id' => '2'
        ]);
    }
}
