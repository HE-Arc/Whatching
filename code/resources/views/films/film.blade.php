<!-- Film page -->

@extends('layouts.app')


@section('content')
<div class="container">

<div class="row">
  <div class="col-md-3">
      <img id="film-cover" src="https://s-media-cache-ak0.pinimg.com/originals/83/89/7e/83897e857be104531da8a2e20e85c5cd.jpg" class="img img-responsive">
  </div>

  <div class="col-md-9 movie-title-case">
      <h1 id="film-name">Fight Club</h1>

      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Suggest it</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Watched</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add to watchlist</button>
      </div>

      <p id="film-synopsis">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
  </div>

</div>

<div class="col-md-12">

  <h1>User's Reviews</h1>

  <section class="comment-list" id="film-reviews">

            @for($i=0; $i<=10; $i++)
            <!-- First Comment -->
            <article class="row">
              <div class="col-md-2 col-sm-2 hidden-xs">
                <figure class="thumbnail">
                  <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                  <figcaption class="text-center">username</figcaption>
                </figure>
              </div>
              <div class="col-md-10 col-sm-10">
                <div class="panel panel-default arrow left">
                  <div class="panel-body">
                    <header class="text-left">
                      <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                      <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                    </header>
                    <div class="comment-post">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                      </p>
                    </div>

                      <div class="star-note text-right">
                        @for($j = 0; $j <5; $j++)
                            <i class="fa fa-star"></i>
                        @endfor
                      </div>

                  </div>
                </div>
              </div>
              </article>
              @endfor



          </section>

</div>



</div>
@endsection
