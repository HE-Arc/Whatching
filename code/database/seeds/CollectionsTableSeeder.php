<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
          'film_id' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('collections')->insert([
          'user_id' => '2',
          'film_id' => '2',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
