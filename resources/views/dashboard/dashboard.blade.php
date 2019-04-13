@extends('layouts.common')

@section('content')
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading mb-5">Welcome {!!strtoupper(Auth::user()->role)!!}</h1>
      <a href="{{ url('managers') }}" class="btn btn-primary"><i class="fa fa-user-md"></i> Managers</a>
      <a href="{{ url('rooms') }}" class="btn btn-secondary"><i class="fa fa-bed"></i> Rooms</a>
      <a href="{{ url('bookings') }}" class="btn btn-success"><i class="fa fa-calendar-check-o"></i> Bookings</a>
    </p>
  </div>
</section>
@endsection