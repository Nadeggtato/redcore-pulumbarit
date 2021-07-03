@extends('layouts.app', ['page' => __('Create Role'), 'pageSlug' => 'roles'])

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{ _('Create User') }}</h5>
        </div>
        <role-create-form></role-create-form>
      </div>
    </div>
  </div>
@endsection
