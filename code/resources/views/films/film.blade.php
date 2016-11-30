<!-- Film page -->

@extends('layouts.app')


@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-3">
      <img id="film-cover" src="http://image.tmdb.org/t/p/w780{{$film->poster_path}}" class="img img-responsive">
    </div>

    <div class="col-md-9 movie-title-case">
      <h1 id="film-name">{{ $film->name }}</h1>

      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suggestModal"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Suggest it</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Watched</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add to watchlist</button>
      </div>

      <p id="film-synopsis">
        {{ $film->synopsis }}
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
            <h4 class="modal-title" id="myModalLabel">Suggest this movie to friends</h4>
          </div>
          <div class="modal-body">

            <form id="suggestForm">
              @forelse ($user->followedUsers as $uf)
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
          film_id: {{$id}},
          state_id: 1,
          source_id: {{Auth::user()->id}}
        },
        dataType: 'json',
        success: function (data) {
          $('#suggestModal').modal('toggle');
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
  });

  </script>

  <script>
    // Change panel color ad toggle the inner checkbox
    function selectRow(elem){
      $("#"+elem.id).toggleClass("selected-row");
      var $tc = $("#"+elem.id).children().find('input:checkbox:first'),
            tv = $tc.attr('checked');
        $tc.attr('checked', !tv);
    }
  </script>

</div>
@endsection
