<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function addCategory($id, $name){
      DB::table('categories')->insert([
        'tmdb_cat_id' => $id,
        'name' => $name
      ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->addCategory(28, 'Action');
      $this->addCategory(12, 'Adventure');
      $this->addCategory(16, 'Animation');
      $this->addCategory(35, 'Comedy');
      $this->addCategory(80, 'Crime');
      $this->addCategory(99, 'Documentary');
      $this->addCategory(18, 'Drama');
      $this->addCategory(10751, 'Family');
      $this->addCategory(14, 'Fantasy');
      $this->addCategory(36, 'History');
      $this->addCategory(27, 'Horror');
      $this->addCategory(10402, 'Music');
      $this->addCategory(9648, 'Mystery');
      $this->addCategory(10749, 'Romance');
      $this->addCategory(878, 'Science Fiction');
      $this->addCategory(10770, 'TV Movie');
      $this->addCategory(53, 'Thriller');
      $this->addCategory(10752, 'War');
      $this->addCategory(37, 'Western');
    }


}
