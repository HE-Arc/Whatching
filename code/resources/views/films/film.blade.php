<!-- Film page -->

@extends('layouts.app')


@section('content')

<div class="col-md-12 top-whatching-film">
  <div class="filter pad-header-film">

    <div class="container">

      <div class="row">
        <div class="col-md-3 col-sm-3">
          <img id="film-cover" src="http://image.tmdb.org/t/p/w780{{$film->poster_path}}" class="img img-responsive">
        </div>

        <div class="col-md-9 col-sm-9 movie-title-case">
          <h1 id="film-name">{{ $film->name }}</h1>

          <div class="btn-group" role="group" aria-label="Basic example">

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suggestModal"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Suggest it</button>

              <form class="" style="display:inline" method="post" action="{{route('filmWatched', ['id' => $film->id])}}">
                <button type="submit" name="submit" class="btn {{$isWatched ? "btn-success" : "btn-primary"}}"><i class="fa fa-eye" aria-hidden="true"></i> Watched </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              @if (!$isInWatchlist && !$isWatched)
                <form class="" style="display:inline" method="post" action="{{route('AddMovieToWatchList', ['id' => $film->id])}}">
                  <button type="submit" name="submit" class="btn btn-primary">Add to my watchlist</button>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              @elseif($isInWatchlist && !$isWatched)
                <span class="label label-info" style="margin-left:30px;">This movie is in your watchlist !</span>
              @endif

          </div>

          <p id="film-synopsis">
            {{ $film->synopsis }}
          </p>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container">

  <div class="row">
    <!-- Modal -->
    <div class="modal fade" id="suggestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Suggest this movie to friends</h4>
          </div>
          <div class="modal-body">

            <form id="suggestForm" onsubmit="return false;">
              @forelse ($suggestableUsers as $uf)
              <div class="panel panel-default">
                <div class="panel-body" onclick="selectRow(this)" id="row-select-user-{{$uf->id}}">
                  <div id="checkbox-select">
                    <input type="checkbox" name="suggestList" value="{{$uf->id}}">{{$uf->name}}<br>
                  </div>
                </div>
              </div>
              @empty
              <b>No one to suggest yet.</b>
              @endforelse
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="submitSuggest" onclick="suggestMovie({{$film->id}}, {{Auth::user()->id}})" class="btn btn-primary">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
  </div>


  <div class="col-md-12">
    <br/>
    <div class="panel panel-default">
      <div class="panel-body">
        <h2 style="font-weight: 800;">Reviews from users</h2>
        <hr/>
        <section class="comment-list" id="film-reviews">
          @if ($film != null)
          <button id="btnReview" class="btn btn-primary btn-lg hidden" data-toggle="modal" data-target="#noteModal"><i class="fa fa-pencil"></i> Write a review</button><br />
          @forelse ($film->notes as $note)
          <!-- First Comment -->
          <article class="row" name="note{{$note->id}}">
            <div class="col-md-2 col-sm-2 hidden-xs">
              <figure class="thumbnail">
                <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                <figcaption class="text-center">{{$note->user->name}}</figcaption>
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><i class="fa fa-user"></i> {{$note->user->name}}</div>
                    <time class="comment-date" datetime="{{$note->created_at->format('d-m-Y h:i')}}"><i class="fa fa-clock-o"></i> {{$note->created_at->format('M d, Y h:i')}}</time>
                  </header>
                  <div class="comment-post">
                    <span id="note{{$note->id}}"><p>{{ $note->comment }}</p></span>
                    <script>mdToHTML("<?php echo str_replace("\r\n", '\r\n<br />', $note->comment); ?>", "note{{$note->id}}");</script>
                  </div>

                  <div class="star-note text-right">
                    @for ($i=1; $i < 11; $i++)
                    @if ($i <= $note->stars)
                    <i class="fa fa-star"></i>
                    @else
                    <i class="fa fa-star" style="color: grey;"></i>
                    @endif
                    @endfor
                  </div>

                </div>
              </div>
            </div>
          </article>
          @empty
          <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default text-center">
              <div class="panel-body">
                <br/>
                <i class="fa fa-plus" style="font-size: 8em; color: #888;"></i>
                <h1>Be the first!</h1>
                <p>You can be the first to review this movie.</p>
                <p><b>Add it to your watchlist and write a review !</b></p>
              </div>
            </div>

          </div>
          @endforelse
          @else
          <b> Not reviewed yet </b>
          @endif

        </section>

      </div>
    </div>
  </div>


  <!-- MODAL NOTE -->
  <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="noteForm" method="post" action="/film/{{ ($personalNote) ? "modifyNote" : "addNote" }}">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Review this movie</h4>
          </div>
          <div class="modal-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <input type="hidden" name="film_id" value="{{$film->id}}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="stars">Stars/10</label>
                  <input id="stars" type="number" min="1" max="10" value="{{ ($personalNote) ? $personalNote->stars : "5" }}" name="stars" class="form-control"/ >
                </div>
                <div class="form-group">
                  <label for="comment">Comment</label>
                  <textarea id="comment" name="comment" class="form-control" rows="5">{{ ($personalNote) ? $personalNote->comment : "" }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="submitNote" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- END MODAL -->

  @if ($isWatched)
  <script>
  $("#btnWatched").toggleClass("btn-success");
  $("#btnReview").toggleClass("hidden");
  </script>
  @endif

</div>
@endsection
