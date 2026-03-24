<div class="col-12 col-md-3 border-end">
    <div class="card-body">
        <h4 class="subheader">General Settings</h4>
        <div class="list-group list-group-transparent">
            <a href="{{ route('admin.general-settings.index') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.general-settings.index') ? 'active' : '' }}">
                Main Settings
            </a>
            <a href="{{ route('admin.logo-settings.index') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.logo-settings.index') ? 'active' : '' }}">
                Logo & Favicon Settings
            </a>
            <a href="{{ route('admin.commission-settings') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.commission-settings') ? 'active' : '' }}">
                Commission Settings
            </a>
            <a href="{{ route('admin.smtp-settings') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.smtp-settings') ? 'active' : '' }}">
                SMTP Settings
            </a>
        </div>
    </div>
</div>
 