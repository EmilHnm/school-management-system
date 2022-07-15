@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-profile">
            <div class="ulogo">
                <a href="/">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>School</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ ($route == 'dashboard') ? 'active':'' }}">
            <a href="/dashboard">
                <i data-feather="pie-chart"></i>
                <span>Dashboard</span>
            </a>
            </li>
            @if (Auth::user()->role == 'Admin')
                <li class="treeview {{ ($prefix == '/users') ? 'active':'' }}" >
                <a href="#" >
                    <i data-feather="user"></i>
                    <span>Manage User</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
                    <li><a href="{{ route('user.add') }}"><i class="ti-more"></i>Add User</a></li>
                </ul>
                </li>
            @endif
            <li class="treeview {{ ($prefix == '/profiles') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
                    <li><a href="{{ route('password.view') }}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/setup') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="settings"></i> <span>Setup Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('student.class.view') }}"><i class="ti-more"></i>Student Class</a></li>
                    <li><a href="{{ route('student.year.view') }}"><i class="ti-more"></i>Student Year</a></li>
                    <li><a href="{{ route('student.group.view') }}"><i class="ti-more"></i>Student Group</a></li>
                    <li><a href="{{ route('student.shift.view') }}"><i class="ti-more"></i>Student Shift</a></li>
                    <li><a href="{{ route('fee.category.view') }}"><i class="ti-more"></i>Fee Category</a></li>
                    <li><a href="{{ route('fee.amount.view') }}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li><a href="{{ route('exam.type.view') }}"><i class="ti-more"></i>Exam Type</a></li>
                    <li><a href="{{ route('school.subject.view') }}"><i class="ti-more"></i>School Subject</a></li>
                    <li><a href="{{ route('assign.subject.view') }}"><i class="ti-more"></i>Assignment Subject</a></li>
                    <li><a href="{{ route('designation.view') }}"><i class="ti-more"></i>Designation</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/students') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="credit-card"></i> <span>Student Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('student.registration.view') }}"><i class="ti-more"></i>Student Registration</a></li>
                    <li><a href="{{ route('student.registration.view') }}"><i class="ti-more"></i>Roll Generate</a></li>

                </ul>
            </li>
            <li class="header nav-small-cap">User Interface</li>
            <li class="treeview">
            <a href="#">
                <i data-feather="grid"></i>
                <span>Components</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
                <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
            </ul>
            </li>



            <li>
            <a href="{{ route('admin.logout') }}">
                <i data-feather="lock"></i>
                <span>Log Out</span>
            </a>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">

        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>

        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
