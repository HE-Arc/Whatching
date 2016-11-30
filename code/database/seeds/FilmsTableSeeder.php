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
        $this->addMovie(680);
        $this->addMovie(16869);
        $this->addMovie(273248);
        $this->addMovie(500);
        $this->addMovie(1422);
        $this->addMovie(862);
        $this->addMovie(344268);
        $this->addMovie(127380);
        $this->addMovie(550);
        $this->addMovie(629);
        $this->addMovie(11324);
        $this->addMovie(27205);
        $this->addMovie(670);
        $this->addMovie(206487);
        $this->addMovie(77);
        $this->addMovie(807);
        $this->addMovie(141);
        $this->addMovie(181886);
        $this->addMovie(8587);
        $this->addMovie(424);
        $this->addMovie(601);
        $this->addMovie(11);
        $this->addMovie(12);
        $this->addMovie(13);
        $this->addMovie(15);
        $this->addMovie(18);
        $this->addMovie(20);
        $this->addMovie(259316);
        $this->addMovie(181808);
        $this->addMovie(181812);
        $this->addMovie(330459);
        $this->addMovie(10196);
        $this->addMovie(329865);
        $this->addMovie(297761);
        $this->addMovie(328111);
        $this->addMovie(269149);
        $this->addMovie(293660);
        $this->addMovie(209112);
        $this->addMovie(223702);
        $this->addMovie(302401);
        $this->addMovie(671);
        $this->addMovie(674);
        $this->addMovie(767);
        $this->addMovie(120);
        $this->addMovie(122);
        $this->addMovie(121);
        $this->addMovie(58);
        $this->addMovie(244786);
        $this->addMovie(399106);
        $this->addMovie(238);
        $this->addMovie(129);
        $this->addMovie(101);
        $this->addMovie(77338);
        $this->addMovie(157336);
        $this->addMovie(264644);
        $this->addMovie(510);
        $this->addMovie(150540);
        $this->addMovie(497);
        $this->addMovie(73);
        $this->addMovie(205596);
        $this->addMovie(118340);
        $this->addMovie(8392);
        $this->addMovie(210577);
        $this->addMovie(106646);
        $this->addMovie(694);
        $this->addMovie(76203);
        $this->addMovie(274);
        $this->addMovie(14312);
        $this->addMovie(429);
        $this->addMovie(103);
        $this->addMovie(335);
        $this->addMovie(28);
        $this->addMovie(146233);
        $this->addMovie(111);
        $this->addMovie(105);
        $this->addMovie(914);
        $this->addMovie(314365);
        $this->addMovie(1124);
        $this->addMovie(406);
        $this->addMovie(5915);
        $this->addMovie(194);
        $this->addMovie(641);
        $this->addMovie(185);
        $this->addMovie(137113);
        $this->addMovie(857);
        $this->addMovie(28178);
        $this->addMovie(68718);
        $this->addMovie(98);
        $this->addMovie(600);
        $this->addMovie(62);
        $this->addMovie(10681);
        $this->addMovie(9421);
        $this->addMovie(207703);
        $this->addMovie(175);
        $this->addMovie(640);
        $this->addMovie(8290);
        $this->addMovie(286217);
        $this->addMovie(13223);
        $this->addMovie(242582);
        $this->addMovie(14160);
        $this->addMovie(33701);
    }

    public function addMovie($tmdbId){

        $movie = Tmdb::getMoviesApi()->getMovie($tmdbId);

        echo 'Adding '.$movie['title']."\n";

        DB::table('films')->insert([
          'filmTMDB_id' => $tmdbId,
          'name' => $movie['title'],
          'synopsis' => $movie['overview'],
          'released_date' => Carbon::createFromFormat('Y-m-d', $movie['release_date']),
          'poster_path' => $movie['poster_path'],
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        sleep(0.25);
    }
}
