<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(CollectionsTableSeeder::class);
         $this->call(FilmsTableSeeder::class);
         $this->call(NotesTableSeeder::class);
         $this->call(PreferencesTableSeeder::class);
         $this->call(SuggestionsTableSeeder::class);

    }
}
