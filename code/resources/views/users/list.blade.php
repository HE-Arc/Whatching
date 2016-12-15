<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')

<div class="col-md-12 top-whatching-film">
  <div class="filter pad-header-film">

    <div class="container">

      <div class="col-md-12">
        <h1 style="font-weight: 800">Hey {{Auth::user()->name}}, discover our great community</h1>
        <p class="lead">
          You should definitely subscribe to some of these people, they are awesome.
        </p>
      </div>

    </div>
  </div>
</div>


<div class="col-md-12">
  <br/>
  <div class="container">


    @forelse ($users as $user)
    @unless ($user->id == Auth::id())
    <div class="col-md-2 col-xs-4">

      <div class="panel panel-default text-center">
        <div class="panel-body">

          <img src="user-placeholder.png" class="img img-responsive img-circle" />
          <a href="user/{{$user->id}}">{{$user->name}}</a>


          <meta name="_token" content="{!! csrf_token() !!}" />
          <p>
            <form method="POST" action="{{ URL::route('subscriptionToggle') }}">

              @if (Auth::user()->followingUsers()->where('followed_id', $user->id)->exists())
              <input type="submit" id="subscribe-toggle" class="btn btn-danger" value="Unsubscribe">
              @else
              <input type="submit" id="subscribe-toggle" class="btn btn-primary" value="Subscribe">
              @endif

              <input type="hidden" name="follower_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="followed_id" value="{{$user->id}}">
              <input type="hidden" name="nojs" value="forthesakeofprogressivenhancement">
              <input type="hidden" name="userlist" value="thisisaworkaround">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </p>


        </div>
      </div>
    </div>
    @endunless

    @empty

    @endforelse


  </div>
</div>
</div>

@endsection
