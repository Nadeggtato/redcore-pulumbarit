<div class="sidebar">
  <div class="sidebar-wrapper">
    <div class="logo">
      <a href="#" class="simple-text logo-mini">{{ _('RS') }}</a>
      <a href="#" class="simple-text logo-normal">{{ _('Redcore') }}</a>
    </div>
    <ul class="nav">
      <li @if ($pageSlug == 'dashboard') class="active " @endif>
        <a href="{{ route('home') }}">
          <i class="tim-icons icon-chart-pie-36"></i>
          <p>{{ _('Dashboard') }}</p>
        </a>
      </li>
      @if(auth('web')->user()->can('viewAny', \App\Models\User::class))
        <li @if ($pageSlug == 'users') class="active " @endif>
          <a href="{{ route('user.show') }}">
            <i class="tim-icons icon-single-02"></i>
            <p>Users</p>
          </a>
        </li>
      @endif
      @if(auth('web')->user()->can('viewAny', \App\Models\Role::class))
        <li @if ($pageSlug == 'roles') class="active " @endif>
          <a href="{{ route('role.index') }}">
            <i class="tim-icons icon-single-02"></i>
            <p>Roles</p>
          </a>
        </li>
      @endif
    </ul>
  </div>
</div>
