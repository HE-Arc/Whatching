<?php

use Illuminate\Database\Seeder;
use Tmdb\Laravel\Facades\Tmdb;
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
        $this->addMovie(109445);


    }

    public function addMovie($tmdbId){

        $movie = Tmdb::getMoviesApi()->getMovie($tmdbId);

        DB::table('films')->insert([
          'filmTMDB_id' => $tmdbId,
          'name' => $movie['title'],
          'synopsis' => $movie['overview'],
          'released_date' => Carbon::createFromFormat('Y-m-d', $movie['release_date']),
          'poster_path' => $movie['poster_path'],
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
