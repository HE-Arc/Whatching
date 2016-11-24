<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
          'name' => 'Fight Club',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('films')->insert([
          'filmTMDB_id' => '68735',
          'name' => 'Warcraft',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('films')->insert([
          'filmTMDB_id' => '109445',
          'name' => 'Frozen',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


    }
}
