<div class="navbar">
    <a href="javascript:void(0)" class="bars" ><i class="bi bi-filter-left"></i></a>
    <div class="navbar-menu">
        <div class="navbar-user">
            <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin <i class="bi bi-chevron-down"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="triggerId">
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-columns-gap me-2"></i> Dashboard</a>
                <a class="dropdown-item" href="{{ route('admin.setting_account') }}"><i class="bi bi-gear me-2"></i> Pengaturan</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a>
            </div>
        </div>
    </div>
</div>