<?php

use Illuminate\Database\Seeder;

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
          'followed_id' => '2'
        ]);

        DB::table('subscriptions')->insert([
          'follower_id' => '2',
          'followed_id' => '1'
        ]);
    }
}
