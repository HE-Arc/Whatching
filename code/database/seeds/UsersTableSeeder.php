<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'toto',
          'email' => 'toto@toto.ch',
          'password' => bcrypt('toto')
        ]);

        DB::table('users')->insert([
          'name' => 'tata',
          'email' => 'tata@tata.ch',
          'password' => bcrypt('tata')
        ]);
    }
}
