<!-- The great homepage -->

@extends('layouts.app')


@section('content')

<div class="col-md-12 top-whatching-header">

  <div class="container top-whatching-container">
    <div class="col-md-8 col-xs-12">
      <h1>Whatching</h1>
      <p class="lead">
        A nano social network focused as much on users as on films.
        Subscribe to people, share movie suggestions and access to your stats
        and personal feed without all the standard social network obsolete content.
      </p>
    </div>
  </div>
</div>


<div class="col-md-12">
  <div class="container">
    <div class="col-md-4 feature-case">
      <h2><i class="fa fa-users" aria-hidden="true"></i> Connect</h2>
      <p>Connect to your friends to know what they watch and when !</p>
    </div>

    <div class="col-md-4 feature-case">
      <h2><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Suggest</h2>
      <p>Rate the movies you watch and create the best collection of the world !</p>
    </div>

    <div class="col-md-4 feature-case">
      <h2><i class="fa fa-share-alt" aria-hidden="true"></i> Share</h2>
      <p>Review and share your point of view with the community !</p>
    </div>
  </div>
</div>

<div class="col-md-12 what-case">

  <div class="container">
    <br/>
    <div class="col-md-6">
      <h1>What should you watch instead of that boring match ?</h1>
      <p>
        Have you ever watched your watch wondering "What should I watch while I am on the couch ?
        I don't really want to watch the match tonight."
      </p>
      <p>
        Whatever, with a Whatching account you would always know what to watch !
      </p>
      <a href="{{url('/signup')}}" class="btn btn-lg btn-danger">Signup</a>
      <a href="{{url('/login')}}" class="btn btn-lg btn-danger">Login</a>
    </div>

    <div class="col-md-6">
      <img src="films.jpg" class="img img-responsive">
    </div>

  </div>
</div>

@endsection
