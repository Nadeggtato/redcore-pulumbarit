@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
  <div class="row">
    <div class="col-12">
      <h2>Welcome, {{ auth('web')->user()->name }}</h2>
    </div>
  </div>
@endsection
