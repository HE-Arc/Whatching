<!-- Feed for a user -->

@extends('layouts.app')


@section('content')
  <div class="container">

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Feed</h1>
      </div>
    </div>
      @forelse ($feed as $line_feed)

        @if ($line_feed[1] == 0)
          <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-md-2 col-xs-3">
                  <img src="http://image.tmdb.org/t/p/w780{{$line_feed[2]->film->poster_path}}" class="film-cover-{{$line_feed[2]->film->id}} img img-responsive">
                </div>
                <div class="col-md-10 col-xs-9 vcenter">
                  <p class="user-card-name">
                    <a href="/user/{{$line_feed[2]->source->id}}">{{$line_feed[2]->source->name}}</a>
                    suggested <a href="/film/{{$line_feed[2]->film->id}}">{{$line_feed[2]->film->name}}</a>
                    to <a href="/user/{{$line_feed[2]->user->id}}">{{$line_feed[2]->user->name}}</a>.
                  </p>
                  <p style="margin-top:50px;">
                  <img src="/user-placeholder.png" class="img img-circle" width="40" /> <i class="fa fa-arrow-right"></i> <img src="/user-placeholder.png" class="img img-circle" width="40" />
                </p>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-6">
                    <em>{{$line_feed[0]}}</em>
                  </div>
                  <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-sm" href="/film/{{$line_feed[2]->film->id}}"><i class="fa fa-eye"></i>&nbsp;Go to the movie page</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @elseif ($line_feed[1] == 1)
          <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-md-2 col-xs-3">
                  <img src="http://image.tmdb.org/t/p/w780{{$line_feed[2]->film->poster_path}}" class="film-cover-{{$line_feed[2]->film->id}} img img-responsive">
                </div>
                <div class="col-md-10 col-xs-9 vcenter">
                  <p class="user-card-name">
                    <a href="/film/{{$line_feed[2]->film->id}}">{{$line_feed[2]->film->name}}</a>
                  </p>
                  <div class="row" style="margin-top:45px;">
                    <div class="col-md-6">
                      <img src="/user-placeholder.png" class="img img-circle" width="40" />
                      <a href="/user/{{$line_feed[2]->user->id}}">{{$line_feed[2]->user->name}}</a>
                    </div>
                    <div class="col-md-6">
                      <div class="star-note text-right">
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
                </div>
              </div>
              <div class="panel-footer">
                <blockquote style="margin-bottom:0px;">
                  {{$line_feed[2]->comment}}
                </blockquote>
                <div class="row">
                  <div class="col-md-6">
                    <em>{{$line_feed[0]}}</em>
                  </div>
                  <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-sm" href="/film/{{$line_feed[2]->film->id}}"><i class="fa fa-eye"></i>&nbsp;Go to the movie page</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        @endif
        @empty
        <p>Follow some people dude ! </p>
      @endforelse

  </div>
@endsection
