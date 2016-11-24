<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
          'follower_id' => '1',
          'followed_id' => '2',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('subscriptions')->insert([
          'follower_id' => '2',
          'followed_id' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }




}
