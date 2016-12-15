<!-- Viewed movies list -->

@extends('layouts.app')


@section('content')
<div class="container">

  <h1>Watched films of <b>{{$user->name}}</b></h1>
  <hr/>
  @foreach ($filmsNotes as $filmNote)
    <div class="row">
      <div class="col-md-2 com-md-offset-2">
        <img id="image_film" src="http://image.tmdb.org/t/p/w780{{$filmNote[0]['poster_path']}}" class="img img-responsive">
      </div>
      <div class="col-md-7 movie-title-case">
      <h1 id="title_film" >{{$filmNote[0]['name']}}</h1>
      <p id="synopsys">
        {{$filmNote[0]['synopsis']}}
      </p>
      @if ($filmNote[1] != null)
        <div class="row">
          <div class="col-md-6">
            <h3 style="margin-top:0px;">Avis de <b>{{$user->name}}</b></h3>
          </div>
          <div class="col-md-6">
            <div class="star-note text-right">
              @for ($i=1; $i < 11; $i++)
                @if ($i <= $filmNote[1]['stars'])
                  <i class="fa fa-star"></i>
                @else
                  <i class="fa fa-star" style="color: grey;"></i>
                @endif
              @endfor
            </div>
          </div>
        </div>

        @if ($filmNote[1]['comment'] != null)
          <blockquote id="comment{{$filmNote[1]['id']}}">{{$filmNote[1]['comment']}}</blockquote>
          <script>mdToHTML("<?php echo str_replace("\r\n", '\r\n<br />',$filmNote[1]['comment']); ?>", "comment{{$filmNote[1]['id']}}");</script>
        @endif
      @endif
      <p>
  </div>
    </div>
    <hr/>
  @endforeach

</div>
@endsection
