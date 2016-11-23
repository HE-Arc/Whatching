<!-- Detailed statistics about user and his suggestions/reviews/etc -->

@extends('layouts.app')


@section('content')
<div class="container">

  <h1>Detailed stats</h1>
  <p>
    The id of that user is : {{$user->id}} and his name : {{$user->name}}
  </p>
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

<h2>Films watched</h2>
<table>
  <tr>
    <th>Film's id</th>
    <th>Film's name</th>
  </tr>
  @foreach ($user->films as $film)
    <tr>
      <td>{{$film->id}}</td>
      <td>{{$film->name}}</td>
    </tr>
  @endforeach
</table>

<h2>People followed</h2>
<table>
  <tr>
    <th>User's id</th>
    <th>User's name</th>
  </tr>
@foreach ($user->usersFollowed as $user)
  <tr>
    <td>{{$user->id}}</td>
    <td>{{$user->name}}</td>
  </tr>
@endforeach
</table>
<!-- ... -->
<h2>People following</h2>
<table>
  <tr>
    <th>User's id</th>
    <th>User's name</th>
  </tr>
@foreach ($user->usersFollowing as $user)
  <tr>
    <td>{{$user->id}}</td>
    <td>{{$user->name}}</td>
  </tr>
@endforeach
</table>
<!-- ... -->

</div>
@endsection
