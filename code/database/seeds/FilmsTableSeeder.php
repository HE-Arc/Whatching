<?php

use Illuminate\Database\Seeder;
use Tmdb\Laravel\Facades\Tmdb;
use Carbon\Carbon;
use App\Film;

class FilmsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $ids = [
            109445,
            680,
            16869,
            273248,
            500,
            1422,
            862,
            344268,
            127380,
            550,
            629,
            11324,
            27205,
            670,
            206487,
            77,
            807,
            141,
            181886,
            8587,
            424,
            601,
            11,
            12,
            13,
            15,
            18,
            20,
            259316,
            181808,
            181812,
            330459,
            10196,
            329865,
            297761,
            328111,
            269149,
            293660,
            209112,
            223702,
            302401,
            671,
            674,
            767,
            120,
            122,
            121,
            58,
            244786,
            399106,
            238,
            129,
            101,
            77338,
            157336,
            264644,
            510,
            150540,
            497,
            73,
            205596,
            118340,
            8392,
            210577,
            106646,
            694,
            76203,
            274,
            14312,
            429,
            103,
            335,
            28,
            146233,
            111,
            105,
            914,
            314365,
            1124,
            406,
            5915,
            194,
            641,
            185,
            137113,
            857,
            28178,
            68718,
            98,
            600,
            62,
            10681,
            9421,
            207703,
            175,
            640,
            8290,
            286217,
            13223,
            242582,
            14160,
            33701,
        ];
        foreach($ids as $id) {
            $this->addMovie($id);
        }
    }

    public function addMovie($tmdbId){

        $movie = Tmdb::getMoviesApi()->getMovie($tmdbId);

        echo 'Adding '.$movie['title']."\n";

        Film::create([
            'filmTMDB_id' => $tmdbId,
            'name' => $movie['title'],
            'synopsis' => $movie['overview'],
            'released_at' => Carbon::createFromFormat('Y-m-d', $movie['release_date']),
            'poster_path' => $movie['poster_path']
        ]);

        sleep(0.25);
    }
}
