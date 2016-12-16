<!-- Feed for a user -->

@extends('layouts.app')


@section('content')
<div class="container">

  <div class="col-md-10 col-md-offset-1 col-xs-12">
    <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="row">
        <div class="col-md-3">
          <strong>Try to feed your feed!</strong>
        </div>
        <div class="col-md-2">
          <a href="{{route('usersList')}}" class="btn btn-primary btn-sm btn-block">Add people</a>
        </div>
        <div class="col-md-2">
          <a href="/film/2" class="btn btn-danger btn-sm btn-block">Watch &amp; Review</a>
        </div>
        <div class="col-md-2">
          <a href="http://www.facebook.com" target="_blank" class="btn btn-success btn-sm btn-block">Invite friends</a>
        </div>
      </div>
    </div>
  </div>


  @forelse ($feed as $line_feed)

  @if ($line_feed[1] == 0)
  <div class="col-md-10 col-md-offset-1 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-2 col-xs-3">
          <img src="http://image.tmdb.org/t/p/w780{{$line_feed[2]->film->poster_path}}" class="film-cover-{{$line_feed[2]->film->id}} img img-responsive">
        </div>
        <div class="col-md-10 col-xs-9 vcenter">
          <p class="user-card-name">
            <a href="/user/{{$line_feed[2]->source->id}}">{{$line_feed[2]->source->name}}</a>
            suggested <a href="/film/{{$line_feed[2]->film->id}}">{{$line_feed[2]->film->name}}</a>
            to <a href="{{route('userProfile', ['id' => $line_feed[2]->user->id])}}">{{$line_feed[2]->user->name}}</a>.
          </p>
          <p>
            <img src="/user-placeholder.png" class="img img-circle" width="40" /> <i class="fa fa-arrow-right"></i> <img src="/user-placeholder.png" class="img img-circle" width="40" />
          </p>
        </div>
        <div class="col-md-3 col-md-offset-9 text-right">
          <em>{{$line_feed[0]}}</em>
        </div>

      </div>
    </div>
  </div>
  @elseif ($line_feed[1] == 1)
  <div class="col-md-10 col-md-offset-1 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-2 col-xs-3">
          <img src="http://image.tmdb.org/t/p/w780{{$line_feed[2]->film->poster_path}}" class="film-cover-{{$line_feed[2]->film->id}} img img-responsive">
        </div>
        <div class="col-md-10 col-xs-9 vcenter">

          <p class="user-card-name">
            <h2 style="font-weight: 800; margin-top: 0;"><a href="/film/{{$line_feed[2]->film->id}}">{{$line_feed[2]->film->name}}</a></h2>
          </p>
          <div class="row">
            <div class="col-md-6">
              <img src="/user-placeholder.png" class="img img-circle" width="40" />
              <a href="{{route('userProfile', ['id' => $line_feed[2]->user->id])}}">{{$line_feed[2]->user->name}}</a> <b>reviewed this movie</b>

              <div class="star-note">
                @for ($i=1; $i < 11; $i++)
                @if ($i <= $line_feed[2]->stars)
                <i class="fa fa-star"></i>
                @else
                <i class="fa fa-star" style="color: grey;"></i>
                @endif
                @endfor
              </div>

            </div>

          </div>

          <div class="row">
            <hr/>
            <div class="well well-lg ">

              <blockquote class="review-feed-block" style="margin-bottom:0px; max-height: 300px; overflow: hidden;">

                <span class="" id="comment{{$line_feed[2]->id}}">{{$line_feed[2]->comment}}</span>
                <script>mdToHTML("<?php echo str_replace("\r\n", '\r\n<br />',$line_feed[2]->comment); ?>", "comment{{$line_feed[2]->id}}");</script>

              </blockquote>

              <div class="col-md-12" >

              </div>
            </div>

            <div class="row">

              <div class="col-md-12">
                @if (strlen($line_feed[2]->comment) > 255)

                <i><a href="{{route('moviePage', ['id' => $line_feed[2]->film->id])}}">Lire la suite</a></i>

                @endif
                <em style="color: #999;" class="pull-right">{{$line_feed[0]}}</em>
              </div>
              <!--<div class="col-md-6 text-right">
              <a class="btn btn-primary btn-sm" href="/film/{{$line_feed[2]->film->id}}"><i class="fa fa-eye"></i>&nbsp;Go to the movie page</a>
            </div>-->
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
@endif
@empty

<div class="col-md-6 col-md-offset-3">

  <div class="panel panel-default text-center">
    <div class="panel-body">
      <br/>
      <i class="fa fa-plus" style="font-size: 8em; color: #888;"></i>
      <h1>Follow some people !</h1>
      <p>You need a few friends to feed your feed.</p>
      <p>
        <a href="{{url('users')}}" class="btn btn-danger">List of Whatching users</a>
      </p>
      <p><b>Or you can search a user in the search bar starting with @</b></p>
    </div>
  </div>

</div>

@endforelse

</div>
@endsection
