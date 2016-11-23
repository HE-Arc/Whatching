<!-- The great homepage -->

@extends('layouts.app')


@section('content')
  <div class="container">

      <h1>Whatching Official Homepage</h1>
      <p class="lead">
        Here you can create an account, login or be redirected on your personal feed.
      </p>


      <h2>Some accessible links</h2>
      <ul>
          <li><a href="{{url('/about')}}">About page</a></li>
          <li><a href="{{url('/feed')}}">Feed page</a></li>
          <li><a href="{{url('/user/88')}}">User 88</a></li>
          <li><a href="{{url('/user/88/films')}}">User 88 watched movies & reviews</a></li>
          <li><a href="{{url('/user/88/stats')}}">User 88 detailed stats</a></li>
      </ul>

  </div>
@endsection
