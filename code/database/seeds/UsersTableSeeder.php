<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
          'password' => bcrypt('toto'),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
          'name' => 'tata',
          'email' => 'tata@tata.ch',
          'password' => bcrypt('tata'),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
