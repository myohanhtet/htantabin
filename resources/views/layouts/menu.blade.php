<!-- need to remove -->

<li class="nav-item">
    <a href="{{ route('dashboard.index') }}" class="rounded-0 nav-link {{ request()->routeIs('dashboard.*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-home"></i>
        <p>{{ __('menu.dashboard') }}</p>
    </a>
</li>

@can('view_pathans')
<li class="nav-item">
    <a href="{{ route('pathans.index') }}" class="rounded-0 nav-link {{ request()->routeIs('pathans.*') ? 'active' : ''}}">
        <i class="nav-icon far fa-address-card"></i>
        <p>{{ __('menu.pathan') }}</p>
    </a>
</li>
@endcan
@can('view_lucky')
<li class="nav-item">
    <a href="{{ route('lucky.index') }}" class="rounded-0 nav-link {{ request()->routeIs('lucky.index') ? 'active' : ''}}">
        <i class="nav-icon fas fa-ticket-alt"></i>
        <p>{{ __('menu.lucky draw') }}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('lucky.find') }}" class="rounded-0 nav-link {{ request()->routeIs('lucky.find') ? 'active' : ''}}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>{{ __('menu.lucky no') }}</p>
    </a>
</li>
@endcan
<li class="nav-item">
    <a href="{{ route('lucky.count') }}" class="rounded-0 nav-link {{ request()->routeIs('lucky.count') ? 'active' : ''}}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>လက်ကျန်ပြေစာ</p>
    </a>
</li>
@can('view_users')
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="rounded-0 nav-link {{ request()->routeIs('users.*') ? 'active' : ''}}">
        <i class="nav-icon fa fa-user"></i>
        <p>{{ __('menu.user') }}</p>
    </a>
</li>
@endcan
@can('view_roles')
<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="rounded-0 nav-link {{ request()->routeIs('roles.*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-award"></i>
        <p>{{ __('menu.role') }}</p>
    </a>
</li>
@endcan
@can('view_permissions')
<li class="nav-item">
    <a href="{{ route('permissions.index') }}" class="rounded-0 nav-link {{ request()->routeIs('permissions.*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-id-card-alt"></i>
        <p>{{ __('menu.permission') }}</p>
    </a>
</li>
@endcan
@can('view_setting')
<li class="nav-item">
    <a href="{{ route('setting.index') }}" class="rounded-0 nav-link {{ request()->routeIs('setting.*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-cogs"></i>
        <p>{{ __('menu.setting') }}</p>
    </a>
</li>
@endcan
