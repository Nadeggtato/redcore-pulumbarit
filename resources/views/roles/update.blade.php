@extends('layouts.app', ['page' => __('Update Role'), 'pageSlug' => 'roles'])

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{ _('Update Role') }}</h5>
        </div>
        <role-update-form :role='@json($role)'></role-update-form>
      </div>
    </div>
  </div>
@endsection
