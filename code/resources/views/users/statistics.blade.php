<!-- Detailed statistics about user and his suggestions/reviews/etc -->

@extends('layouts.app')


@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-2 col-sm-2">
      <img src="/user-placeholder.png" class="img img-responsive img-circle" />
    </div>
    <div class="col-md-10 col-sm-10">
      <h1>{{$user->name}}</h1>
      <p>
        {{$quote}}
      </p>
    </div>
  </div>


  <div class="row stat-row text-center">
    <div class="col-md-3 col-sm-3 col-xs-6">
      <h1>{{$user->films->count()}}</h1>
      <h2>watched movies</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
      <h1>{{$user->notes->count()}}</h1>
      <h2>reviews</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
      <h1>{{$user->followedUsers->count()}}</h1>
      <h2>followers</h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
      <h1>{{$user->followingUsers->count()}}</h1>
      <h2>following</h2>
    </div>
  </div>

  <hr/>
  <h2>Films watched</h2>

  <div class="row">
    @forelse ($user->films as $film)
    <div class="col-md-3 col-sm-4 col-xs-12 watched-movie-case">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-12 col-xs-12 vcenter">
            <p class="text-center movie-card-name">
              <a href="/film/{{$film->id}}">{{$film->name}}</a>
            </p>
          </div>
        </div>
        <div class="panel-footer text-center">
          <div class="star-note">
            @for($j = 0; $j <5; $j++)
            <i class="fa fa-star"></i>
            @endfor
          </div></div>
        </div>
      </div>
    @empty
      No movies.
    @endforelse
    </div>

    <div class="row">
      <div class="col-md-12">
        <a href="/user/{{$user->id}}/films" class="btn btn-default" >See full list</a>
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

<hr/>
<h2>People followed</h2>

<div class="row">
  @forelse ($user->followedUsers as $user)
  <div class="col-md-6 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-2 col-xs-3">
          <img src="/user-placeholder.png" class="img img-responsive img-circle" />
        </div>
        <div class="col-md-10 col-xs-9 vcenter">
          <p class="user-card-name">
            <a href="/user/{{$user->id}}">{{$user->name}}</a>
          </p>
          <p class="user-card-bio">
            Hey this is my cool bio I love Star Wars !
          </p>
        </div>
      </div>
      <div class="panel-footer text-right">
        <a class="btn btn-primary btn-sm" href="/user/{{$user->id}}"><i class="fa fa-eye"></i>&nbsp;Voir le profil</a>
      </div>
    </div>
  </div>
  @empty
  @endforelse
</div>


<hr/>
<h2>People following</h2>

<div class="row">
  @foreach ($user->followingUsers as $user)
  <div class="col-md-6 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-2 col-xs-3">
          <img src="/user-placeholder.png" class="img img-responsive img-circle" />
        </div>
        <div class="col-md-10 col-xs-9 vcenter">
          <p class="user-card-name">
            <a href="/user/{{$user->id}}">{{$user->name}}</a>
          </p>
          <p class="user-card-bio">
            Hey this is my cool bio I love Star Wars !
          </p>
        </div>
      </div>
      <div class="panel-footer text-right">
        <a class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;Follow</a>
        <a class="btn btn-primary btn-sm" href="/user/{{$user->id}}"><i class="fa fa-eye"></i>&nbsp;Voir le profil</a>
      </div>
    </div>
  </div>
  @endforeach
</div>

</div>
@endsection
