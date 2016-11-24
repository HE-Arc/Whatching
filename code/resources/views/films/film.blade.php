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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suggestModal"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Suggest it</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Watched</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add to watchlist</button>
      </div>

      <p id="film-synopsis">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>

  </div>


  <div class="row">
    <!-- Modal -->
    <div class="modal fade" id="suggestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Suggest a movie to a friend</h4>
          </div>
          <div class="modal-body">

            <form id="suggestForm">
              @forelse ($user->followedUsers as $uf)
              <div class="panel panel-default">
                <div class="panel-body">
                  <input type="checkbox" name="suggestList" value="{{$uf->id}}">{{$uf->name}}<br>
                </div>
              </div>
              @empty
              <b>No one to suggest yet.</b>
              @endforelse
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="submitSuggest" class="btn btn-primary">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
  </div>


  <div class="col-md-12">

    <h1>User's Reviews</h1>

    <section class="comment-list" id="film-reviews">
      @if ($film != null)

      @forelse ($film->notes as $note)
      <!-- First Comment -->
      <article class="row">
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
                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
              </header>
              <div class="comment-post">
                <p>
                  {{ $note->comment }}
                </p>
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
      <b> Not reviewed yet </b>
      @endforelse

      @else
      <b> Not reviewed yet </b>
      @endif

    </section>

  </div>

  <script>
  getMovieFromTMDb({{$id}}, '#film-name', '#film-cover', '#film-synopsis');
  </script>

  <script>
  $("#submitSuggest").click(function (e) {

    var suggestionsIds = [];
    $(':checkbox:checked').each(function(i){
      suggestionsIds[i] = $(this).val();
    });

    if(suggestionsIds < 1){
      alert("Choose someone !");
    }else{

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })

      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "/film/suggestToFriend",
        data: {
          user_ids: suggestionsIds,
          film_id: {{$film->id}},
          state_id: 1,
          source_id: {{Auth::user()->id}}
        },
        dataType: 'json',
        success: function (data) {
          alert("Suggestions successfully added!");
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
  });
  </script>

  <script>

    function selectRow(elem){
      // Some pretty coloration
      alert($(elem).parent());
    }

  </script>

  <script>
  getMovieFromTMDb({{$id}}, '#film-cover', '#film-name', '#film-synopsis');
  </script>

</div>
@endsection
