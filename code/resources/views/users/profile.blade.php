<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')
<div class="container">


  <div class="container">

    <div class="row">
      <!--  <div class="col-md-2 col-sm-2">
      <img src="/user-placeholder.png" class="img img-responsive img-circle" />
    </div> -->
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-10 col-sm-10">
          <h1 style="font-weight: 800;">{{$user->name}}</h1>
        </div>
        <div class="col-md-2 col-sm-2">
          @unless ($id == Auth::user()->id)
          <meta name="_token" content="{!! csrf_token() !!}" />
          <p>
            <form method="POST" onsubmit="return false;" action="{{ URL::route('subscriptionToggle') }}">
              @if ($canSub)
              <input type="submit" id="subscribe-toggle" class="btn btn-primary" onclick="subscribeTo({{Auth::user()->id}}, {{$id}})" value="Subscribe">
              @else
              <input type="submit" id="subscribe-toggle" class="btn btn-danger" onclick="subscribeTo({{Auth::user()->id}}, {{$id}})" value="Unsubscribe">
              @endif
              <input type="hidden" name="follower_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="followed_id" value="{{$id}}">
              <input type="hidden" name="nojs" value="forthesakeofprogressivenhancement">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </p>
          @endunless
        </div>


      </div>


      <div class="row stat-row text-center stats-bloc">
        <div class="col-md-3 col-sm-3 col-xs-6">
          <h1>{{$user->films->count()}}</h1>
          <a href="#films-watched"><h2>watched movies</h2></a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <h1>{{$user->notes->count()}}</h1>
          <a href="#notes-comments"><h2>reviews</h2></a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <h1>{{$user->followedUsers->count()}}</h1>
          <a href="#people-followed"><h2>followers</h2></a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <h1>{{$user->followingUsers->count()}}</h1>
          <a href="#people-following"><h2>following</h2></a>
        </div>
        <p>
          &nbsp; <!-- yess I am ugly -->
        </p>
      </div>
    </div>

  </div>

  <div class="row">
            <a name="films-watched"></a>
    <div class="panel panel-default">
      <div class="panel-body">

        <h2 style="font-weight: 800;">Films watched</h2>
        <hr/>


        <div class="row">
          @forelse ($user->films as $film)
          <div class="col-md-3 col-sm-4 col-xs-12 watched-movie-case">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-md-12 col-xs-12 vcenter">
                  <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2/{{$film->poster_path}}" class="img img-responsive">
                  <p class="text-center movie-card-name">
                    <a href="/film/{{$film->id}}">{{str_limit($film->name, $limit = 20, $end = '...')}}</a>
                  </p>
                </div>
              </div>
              <!-- <div class="panel-footer text-center">
              <div class="star-note">
              @for($j = 0; $j <5; $j++)
              <i class="fa fa-star"></i>
              @endfor
            </div>
          </div>-->
        </div>
      </div>


      @if ($loop->last)


      <div class="col-md-12">
        <a href="/user/{{$user->id}}/films" class="btn btn-default" ><i class="fa fa-film"></i>&nbsp; See developed list</a>
      </div>


      @endif

      @empty

      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default text-center">
          <div class="panel-body">
            <br/>
            <i class="fa fa-film" style="font-size: 8em; color: #888;"></i>
            <h1>Whatch some stuff !</h1>
            <p>Your watch list is empty.</p>
            <p>
            </p>
            <p><b>Type the name of a movie you watched in the search bar ;)</b></p>
          </div>
        </div>

      </div>
      @endforelse
    </div>
  </div>
</div>

</div>

<div class="row">
    <a name="notes-comments"></a>
  <div class="panel panel-default">
    <div class="panel-body">

      <h2 style="font-weight: 800;">Notes and comments</h2>
      <hr/>
<div class="row">
@forelse ($user->notes as $note)
  <div class="col-md-6 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-2 col-xs-3">
          <img src="http://image.tmdb.org/t/p/w780{{$note->film->poster_path}}" class="film-cover-{{$note->film->id}} img img-responsive">
        </div>
        <div class="col-md-10 col-xs-9 vcenter">
          <p class="user-card-name">
            <a href="/film/{{$note->film->id}}">{{$note->film->name}}</a>
          </p>
          <div class="row" style="margin-top:45px;">
            <div class="col-md-offset-6 col-md-6">
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
      </div>
      <div class="panel-footer">
        <blockquote style="margin-bottom:0px;">
            <span id="comment{{$note->id}}">{{$note->comment}}</span>
            <script>mdToHTML("<?php echo str_replace("\r\n", '\r\n<br />',$note->comment); ?>", "comment{{$note->id}}");</script>

        </blockquote>
        <div class="row">
          <div class="col-md-6">
            <em>{{$note->created_at}}</em>
          </div>
          <div class="col-md-6 text-right">
            <a class="btn btn-primary btn-sm" href="/film/{{$note->film->id}}"><i class="fa fa-eye"></i>&nbsp;Go to the movie page</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@empty

@endforelse
</div>
</div>
</div>
</div>

<!--

<h2>Notes</h2>
<table>
<tr>
<th>Film's id</th>
<th>Comment</th>
<th>Stars</th>
</tr>
@foreach ($user->notes as $note)
<tr>
<td>{{$note->id}}</td>
<td>{{$note->comment}}</td>
<td>{{$note->stars}}</td>
</tr>
@endforeach
</table>
-->

<div class="row">
  <a name="people-following"></a>
  <div class="panel panel-default">
    <div class="panel-body">

      <h2 style="font-weight: 800;">People following {{$user->name}}</h2>
      <hr/>

      @forelse ($user->followedUsers as $ufd)
      <div class="col-md-2 col-xs-2 text-center">
        <div class="panel panel-default">
          <div class="panel-body">
            <img src="/user-placeholder.png" class="img img-responsive img-circle" /><br/>
            <p class="user-card-name">
              <a href="/user/{{$ufd->id}}">{{str_limit($ufd->name, $limit = 8, $end = '...')}}</a>
            </p>
          </div>
        </div>
      </div>
      @empty

      <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-default text-center">
          <div class="panel-body">
            <br/>
            <i class="fa fa-users" style="font-size: 8em; color: #888;"></i>
            <h1>Be interesting !</h1>
            <p>Add watched movies and review them !</p>
            <p>
          </p>
            <p><b>Type the name of a movie you watched in the search bar ;)</b></p>
          </div>
        </div>

      </div>

      @endforelse
    </div>
  </div>
</div>


<div class="row">
    <a name="people-followed"></a>
  <div class="panel panel-default">
    <div class="panel-body">

      <h2 style="font-weight: 800;">People followed by {{$user->name}}</h2>
      <hr/>

      @forelse ($user->followingUsers as $ufr)

      <div class="col-md-2 col-xs-2 text-center">
        <div class="panel panel-default">
          <div class="panel-body">
            <img src="/user-placeholder.png" class="img img-responsive img-circle" /><br/>
            <p class="user-card-name">
              <a href="/user/{{$ufr->id}}">{{str_limit($ufr->name, $limit = 8, $end = '...')}}</a>
            </p>
          </div>
        </div>
      </div>

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

  </div>
</div>

</div>

</div>

@endsection
