<div id="main">

    <!-- top bar navigation -->
    <div class="headerbar">

        <!-- LOGO -->
        <div class="headerbar-left">
            <a href="#" class="logo">
                <span>Admin Dashboard</span>
            </a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">
                <li class="list-inline-item dropdown notif">
                    <a href="{{ url('/logout') }}" class="smoothScroll">Logout</a>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left">
                        <i class="fas fa-bars"></i>
                    </button>
                </li>
            </ul>

        </nav>

    </div>
    <!-- End Navigation -->

    <!-- Left Sidebar -->
    <div class="left main-sidebar">

        <div class="sidebar-inner leftscroll">

            <div id="sidebar-menu">

                <ul>

                    <li class="submenu">
                        <a href="{{ url('/admin/activity') }}">
                            <i class="fas fa-chart-line"></i>
                            <span> Activity </span>
                        </a>
                    </li>

                    <li class="submenu">
                        <a href="{{ url('/admin/appointments') }}">
                            <i class="far fa-clipboard"></i>
                            <span> Approve Appointments </span>
                        </a>
                    </li>

                    <li class="submenu">
                        <a href="{{ url('/admin/doctors') }}">
                            <i class="fas fa-user-md"></i>
                            <span> Doctors </span>
                        </a>
                    </li>

                    <li class="submenu">
                        <a href="{{ url('/admin/users') }}">
                            <i class="fas fa-user-friends"></i>
                            <span> Users </span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('/admin/pets') }}">
                            <i class="fas fa-cat"></i>
                            <span> Pets </span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('/admin/medications') }}">
                            <i class="fas fa-pills"></i>
                            <span> Medications </span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('/admin/diagnosis') }}">
                            <i class="fas fa-briefcase-medical"></i>
                            <span> Diagnosis </span>
                        </a>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('/admin/types') }}">
                            <i class="fas fa-paw"></i>
                            <span> Pet Types </span>
                        </a>
                    </li>


                </ul>

                <div class="clearfix"></div>

            </div>

            <div class="clearfix"></div>

        </div>

    </div>
