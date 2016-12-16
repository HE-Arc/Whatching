<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')
<div class="container">


  <div class="row">

    <div class="col-md-10 col-md-offset-1 col-xs-12">

      <div class="panel panel-default">
        <div class="panel-body">

          <h2 style="font-weight: 800;">Pending suggestions</h2>
          <hr/>

          @forelse ($pendingSuggestions as $suggestion)

          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading" style="margin-bottom: 0;">
                {{str_limit($suggestion->film->name, 16, '...')}}
              </div>
              <div class="panel-body" style="padding-top: 0;">
                <div class="row">
                  <img src="http://image.tmdb.org/t/p/w780{{$suggestion->film->poster_path}}" class="film-cover-{{$suggestion->film->id}} img img-responsive">
                </div>
                <div class="col-md-10 col-xs-9">
                  <p>
                    <br/>
                    <b>suggested</b> by <a href="/user/{{$suggestion->source->id}}">{{$suggestion->source->name}}</a>
                  </p>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <a class="btn btn-default" title="Go to movie page" href="{{route('moviePage', ['id' => $suggestion->film->id])}}"><i class="fa fa-eye"></i></a>
                    <form style="display:inline" method="post" action="{{route('acceptSuggestion', ['id' => $suggestion->id])}}">
                      <button type="submit" title="Add to watchlist" name="submit" class="btn btn-default"><i class="fa fa-plus"></i></button>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    <form style="display:inline" method="post" action="{{route('refuseSuggestion', ['id' => $suggestion->id])}}">
                      <button type="submit" title="Refuse suggestion" name="submit" class="btn btn-default"><i class="fa fa-times"></i></button>
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
      </div>
    </div>
  </div>


  <div class="row">

    <div class="col-md-10 col-md-offset-1 col-xs-12">
      <a name="watchlist"></a>
      <div class="panel panel-default">
        <div class="panel-body">

          <h2 style="font-weight: 800;">Watchlist</h2>
          <hr/>

          @forelse ($user->acceptedSuggestions as $suggestion)

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
                  <form style="display:inline" method="post" action="{{route('refuseSuggestion', ['id' => $suggestion->id])}}">
                    <input type="submit" name="submit" class="btn btn-default" value="Finally no">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </form>
                </div>
              </div>
            </div>
          </div>

          @empty
          <p>Vous n'avez pas de film en attente</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
