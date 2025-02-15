<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('crm.main.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('crm.client.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Clients
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('crm.project.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-project-diagram"></i>
                    <p>
                        Projects
                    </p>
                </a>
            </li>

            @can('view', auth()->user())
                <li class="nav-item">
                    <a href="{{ route('crm.task.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Tasks
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('crm.user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
