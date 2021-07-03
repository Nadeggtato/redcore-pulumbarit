@extends('layouts.app', ['page' => __('Update User'), 'pageSlug' => 'users'])

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{ _('Update User') }}</h5>
        </div>
        <user-update-form :user='@json($user)'></user-update-form>
      </div>
    </div>
  </div>
@endsection
