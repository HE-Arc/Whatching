<!-- Viewed movies list -->

@extends('layouts.app')


@section('content')
<div class="container">

  <h1>Watched films of <b>{{$user->name}}</b></h1>
  <hr/>
  @foreach ($filmsNotes as $filmNote)
    <div class="row">
      <div class="col-md-2 com-md-offset-2">
        <img id="image_film" src="https://s-media-cache-ak0.pinimg.com/originals/83/89/7e/83897e857be104531da8a2e20e85c5cd.jpg" class="img img-responsive">
      </div>
      <div class="col-md-7 movie-title-case">
      <h1 id="title_film" >{{$filmNote[0]['name']}}</h1>
      <p id="synopsys">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
