<div class="col-12 col-md-3 border-end">
    <div class="card-body">
        <h4 class="subheader">General Settings</h4>
        <div class="list-group list-group-transparent">
            <a href="{{ route('admin.settings.main') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.settings.main') ? 'active' : '' }}">Main Settings</a>
            <a href="{{ route('admin.commission-settings.index') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.commission-settings.index') ? 'active' : '' }}">Commission Settings</a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center">Connected Apps</a>
            <a href="./settings-plan.html"
                class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center">Billing &amp; Invoices</a>
        </div>
        <h4 class="subheader mt-4">Experience</h4>
        <div class="list-group list-group-transparent">
            <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
        </div>
    </div>
</div>
