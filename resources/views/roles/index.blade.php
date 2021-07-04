@extends('layouts.app', ['pageSlug' => 'roles'])

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if(session()->has('success'))
        <div class="alert alert-success">
          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tim-icons icon-simple-remove"></i>
          </button>
          <span>
            <b> Success - </b> {{ session()->get('success') }}</span>
        </div>
      @endif
      <div class="card ">
        <div class="card-header">
          <div class="row">
            <div class="col-8">
              <h4 class="card-title">Roles</h4>
            </div>
            @if(auth('web')->user()->can('create', \App\Models\Role::class))
              <div class="col-4 text-right">
                <a href="{{ route('role.create.form') }}" class="btn btn-sm btn-primary">Add role</a>
              </div>
            @endif
          </div>
        </div>
        <div class="card-body">
          <roles-table :can-edit="{{ auth('web')->user()->can('update role') ? 'true' : 'false' }}"
                       :can-delete="{{ auth('web')->user()->can('delete role') ? 'true' : 'false' }}"></roles-table>
        </div>

        <div class="card-footer py-4">

          <nav class="d-flex justify-content-end" aria-label="...">

          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection
