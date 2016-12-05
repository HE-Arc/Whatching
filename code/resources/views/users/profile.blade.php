<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')
<div class="container">

  <h1>Profile page</h1>
  <p>
    The id of that user is : {{$id}}
  </p>

  @unless ($id == Auth::user()->id)
  <meta name="_token" content="{!! csrf_token() !!}" />
  <p>
    <form method="POST" action="{{ URL::route('subscriptionToggle') }}">
    @if ($canSub)
    <input type="submit" id="subscribe-toggle" class="btn btn-primary" value="Subscribe">
    @else
    <input type="submit" id="subscribe-toggle" class="btn btn-danger" value="Unsubscribe">
    @endif
    <input type="hidden" name="follower_id" value="{{Auth::user()->id}}">
    <input type="hidden" name="followed_id" value="{{$id}}">
    <input type="hidden" name="nojs" value="forthesakeofprogressivenhancement">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  </form>
  </p>
  @endunless

</div>


<script>
$("#subscribe-toggle").click(function (e) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "/user/subscribeToggle",
    data: {
      follower_id: {{Auth::user()->id}},
      followed_id: {{$id}}
    },
    dataType: 'json',
    success: function (data) {
      if(data.action == "sub"){
        $('#subscribe-toggle').attr('class', 'btn btn-danger');
        $('#subscribe-toggle').html("Unsubscribed");
      }else{
        $('#subscribe-toggle').attr('class', 'btn btn-primary');
        $('#subscribe-toggle').html("Subscribe");
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
});
</script>

@endsection
