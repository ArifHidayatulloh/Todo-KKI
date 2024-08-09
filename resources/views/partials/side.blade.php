<style>
    .nav-item p {
        font-size: 15.5px;
    }
</style>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{asset('assets/image/logo_koperasi_indonesia.png')}}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">KKI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info" style="width: 100%">
                <a href="#" class="d-block text-center">{{session('nama')}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (session('level') == 1 || session('level') == 2)
                    <li class="nav-item">
                        <a href="/departemen/index" class="nav-link">
                            <i class="nav-icon fas fa-landmark"></i>
                            <p>
                                Departemen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/karyawan/index" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Karyawan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/departemen_user/index" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Departemen User
                            </p>
                        </a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a href="/todo/index" class="nav-link">
                            <i class="nav-icon fas fa-list-ol"></i>
                            <p>
                                To Do
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/todo/index" class="nav-link">
                            <i class="nav-icon fas fa-list-ol"></i>
                            <p>
                                To Do
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Sign Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
