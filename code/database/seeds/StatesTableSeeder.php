<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
          'name' => 'Pending',
          'description' => 'The suggestion is waiting for your approval.'
        ]);

        DB::table('states')->insert([
          'name' => 'Accepted',
          'description' => 'The suggestion is accepted.'
        ]);

        DB::table('states')->insert([
          'name' => 'Refused',
          'description' => 'The suggestion is refused.'
        ]);

        DB::table('states')->insert([
          'name' => 'Viewed',
          'description' => 'The movie has been viewed.'
        ]);
    }
}
