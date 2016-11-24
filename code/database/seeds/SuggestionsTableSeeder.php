<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SuggestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('suggestions')->insert([
        'user_id' => '2',
        'film_id' => '3',
        'state_id' => '1',
        'source_id' => '1',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

    }
}
