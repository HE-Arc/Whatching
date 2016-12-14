<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')
<div class="container">
  <div class="container">


    @forelse ($users as $user)

    <div class="col-md-6 col-xs-12">

      <div class="panel panel-default">
        <div class="panel-body">
          <a href="user/{{$user->id}}">{{$user->name}}</a>

          @unless ($user->id == Auth::id())
          <meta name="_token" content="{!! csrf_token() !!}" />
          <p>
            <form method="POST" action="{{ URL::route('subscriptionToggle') }}">

              @if (Auth::user()->followedUsers()->where('followed_id', $user->id)->exists())
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
          @endunless

        </div>
      </div>

    </div>

    @empty

    @endforelse


  </div>
</div>

@endsection
