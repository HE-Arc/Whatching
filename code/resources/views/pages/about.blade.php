<!-- About page with concept explanations -->

@extends('layouts.app')


@section('content')
  <div class="container">
      <h1>Whatching <small>What is it ?</small></h1>
      <p class="lead">
        A nano social network focused as much on users as on films. Subscribe to people, share movie suggestions and access to your stats and personal feed without all the standard social network obsolete content.
      </p>
      <blockquote>
          A love story between you, other users and films.
          <footer>Dominique Ducommun</footer>
      </blockquote>
      <h2>Features <small>Cool things you can do</small></h2>
      <ul>
          <li>Authentication</li>
          <li>Subscribe / Unsubscribe to other users</li>
          <li>Suggest a movie</li>
          <li>Get a movie suggestion</li>
          <li>Access to your and other users' profile stats</li>
          <li>Access to detailed lists of watched movies, <i>build your collection !</i></li>
      </ul>
  </div>
@endsection
