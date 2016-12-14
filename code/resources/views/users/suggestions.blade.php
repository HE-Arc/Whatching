<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')
<div class="container">

  <div class="row">
    <center><h2>Suggestions en attente</h2></center>
    @forelse ($pendingSuggestions as $suggestion)

      <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-2 col-xs-3">
              <img src="http://image.tmdb.org/t/p/w780{{$suggestion->film->poster_path}}" class="film-cover-{{$suggestion->film->id}} img img-responsive">
            </div>
            <div class="col-md-10 col-xs-9 vcenter">
              <p class="user-card-name">
                <a href="/user/{{$suggestion->source->id}}">{{$suggestion->source->name}}</a>
                <b>suggested</b> <a href="/film/{{$suggestion->film->id}}">{{$suggestion->film->name}}</a>
                to you.
              </p>
              <p style="margin-top:50px;">
              <img src="/user-placeholder.png" class="img img-circle" width="40" /> <i class="fa fa-arrow-right"></i> <img src="/user-placeholder.png" class="img img-circle" width="40" />
            </p>
            </div>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-12 text-right">
                <a class="btn btn-primary btn-sm" href="{{route('moviePage', ['id' => $suggestion->film->id])}}"><i class="fa fa-eye"></i>&nbsp;Go to the movie page</a>
                <form style="display:inline" method="post" action="{{route('acceptSuggestion', ['id' => $suggestion->id])}}">
                  <input type="submit" name="submit" class="btn btn-success btn-sm" value="Add to my watchlist">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                <form style="display:inline" method="post" action="{{route('refuseSuggestion', ['id' => $suggestion->id])}}">
                  <input type="submit" name="submit" class="btn btn-danger btn-sm" value="No, I wont !">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <p>Vous n'avez pas de suggestions en attente</p>
    @endforelse
  </div>
  <div class="row">
    <center><h2>Les films à voir</h2></center>
    @forelse ($user->acceptedSuggestions as $suggestion)
      <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-2 col-xs-3">
              <img src="http://image.tmdb.org/t/p/w780{{$suggestion->film->poster_path}}" class="film-cover-{{$suggestion->film->id}} img img-responsive">
            </div>
            <div class="col-md-10 col-xs-9 vcenter">
              <p class="user-card-name">
                <a href="/film/{{$suggestion->film->id}}">{{$suggestion->film->name}}</a>
              </p>
              <p style="">
                {{ $suggestion->film->synopsis }}
              </p>
            </div>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-12 text-right">
                <a class="btn btn-primary btn-sm" href="/film/{{$suggestion->film->id}}"><i class="fa fa-eye"></i>&nbsp;Go to the movie page</a>
                <form style="display:inline" method="post" action="{{route('refuseSuggestion', ['id' => $suggestion->id])}}">
                  <input type="submit" name="submit" class="btn btn-danger btn-sm" value="No, I wont !">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <p>Vous n'avez pas de film en attente</p>
    @endforelse
  </div>

</div>

@endsection
