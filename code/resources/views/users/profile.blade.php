<!-- Overview of a profile -->

@extends('layouts.app')


@section('content')
<div class="container">

  <h1>Profile page</h1>
  <p>
    The id of that user is : {{$id}}
  </p>

  <p>
    @if ($canSub)
      <button id="subscribe-toggle" class="btn btn-primary">Subscribe</button>
    @else
      <button id="subscribe-toggle" class="btn btn-danger">Unsubscribed</button>
    @endif
  </p>
  <meta name="_token" content="{!! csrf_token() !!}" />

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
