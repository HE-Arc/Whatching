<?php

use Illuminate\Database\Seeder;
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
          'user_id' => '1',
          'film_id' => '1',
          'comment' => 'Ce film est trop bien',
          'stars' => '10',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('notes')->insert([
          'user_id' => '2',
          'film_id' => '2',
          'comment' => 'Ce film est nul',
          'stars' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
