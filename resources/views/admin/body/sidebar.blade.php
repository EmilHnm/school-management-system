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
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="" width="30" height="30">
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
                    <li class="{{ $route == 'user.view' ? 'active' : '' }}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
                    <li class="{{ $route == 'user.add' ? 'active' : '' }}"><a href="{{ route('user.add') }}"><i class="ti-more"></i>Add User</a></li>
                </ul>
                </li>
            @endif
            <li class="treeview {{ ($prefix == '/profiles') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="credit-card"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'profile.view' ? 'active' : '' }}"><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
                    <li class="{{ $route == 'password.view' ? 'active' : '' }}"><a href="{{ route('password.view') }}"><i class="ti-more"></i>Change Password</a></li>
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
                    <li class="{{ $route == 'student.class.view' ? 'active' : '' }}"><a href="{{ route('student.class.view') }}"><i class="ti-more"></i>Student Class</a></li>
                    <li class="{{ $route == 'student.year.view' ? 'active' : '' }}"><a href="{{ route('student.year.view') }}"><i class="ti-more"></i>Student Year</a></li>
                    <li class="{{ $route == 'student.group.view' ? 'active' : '' }}"><a href="{{ route('student.group.view') }}"><i class="ti-more"></i>Student Group</a></li>
                    <li class="{{ $route == 'student.shift.view' ? 'active' : '' }}"><a href="{{ route('student.shift.view') }}"><i class="ti-more"></i>Student Shift</a></li>
                    <li class="{{ $route == 'fee.category.view' ? 'active' : '' }}"><a href="{{ route('fee.category.view') }}"><i class="ti-more"></i>Fee Category</a></li>
                    <li class="{{ $route == 'fee.amount.view' ? 'active' : '' }}"><a href="{{ route('fee.amount.view') }}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li class="{{ $route == 'exam.type.view' ? 'active' : '' }}"><a href="{{ route('exam.type.view') }}"><i class="ti-more"></i>Exam Type</a></li>
                    <li class="{{ $route == 'school.subject.view' ? 'active' : '' }}"><a href="{{ route('school.subject.view') }}"><i class="ti-more"></i>School Subject</a></li>
                    <li class="{{ $route == 'assign.subject.view' ? 'active' : '' }}"><a href="{{ route('assign.subject.view') }}"><i class="ti-more"></i>Assignment Subject</a></li>
                    <li class="{{ $route == 'designation.view' ? 'active' : '' }}"><a href="{{ route('designation.view') }}"><i class="ti-more"></i>Designation</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/students') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="users"></i> <span>Student Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'student.registration.view' ? 'active' : '' }}"><a href="{{ route('student.registration.view') }}"><i class="ti-more"></i>Student Registration</a></li>
                    <li class="{{ $route == 'roll.generate.view' ? 'active' : '' }}"><a href="{{ route('roll.generate.view') }}"><i class="ti-more"></i>Roll Generate</a></li>
                    <li class="{{ $route == 'registration.fee.view' ? 'active' : '' }}"><a href="{{ route('registration.fee.view') }}"><i class="ti-more"></i>Registrantion Fee</a></li>
                    <li class="{{ $route == 'monthly.fee.view' ? 'active' : '' }}"><a href="{{ route('monthly.fee.view') }}"><i class="ti-more"></i>Monthly Fee</a></li>
                    <li class="{{ $route == 'exam.fee.view' ? 'active' : '' }}"><a href="{{ route('exam.fee.view') }}"><i class="ti-more"></i>Exam Fee</a></li>

                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/employees') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="package"></i> <span>Employee Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'employee.registration.view' ? 'active' : '' }}"><a href="{{ route('employee.registration.view') }}"><i class="ti-more"></i>Employee Registration</a></li>
                    <li class="{{ $route == 'employee.salary.view' ? 'active' : '' }}"><a href="{{ route('employee.salary.view') }}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li class="{{ $route == 'employee.leave.view' ? 'active' : '' }}"><a href="{{ route('employee.leave.view') }}"><i class="ti-more"></i>Employee Leave</a></li>
                    <li class="{{ $route == 'employee.attendance.view' ? 'active' : '' }}"><a href="{{ route('employee.attendance.view') }}"><i class="ti-more"></i>Employee Attendance</a></li>
                    <li class="{{ $route == 'employee.monthly.salary.view' ? 'active' : '' }}"><a href="{{ route('employee.monthly.salary.view') }}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/marks') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="bookmark"></i> <span>Marks Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'marks.entry.add' ? 'active' : '' }}"><a href="{{ route('marks.entry.add') }}"><i class="ti-more"></i>Marks Entry</a></li>
                    <li class="{{ $route == 'marks.entry.edit' ? 'active' : '' }}"><a href="{{ route('marks.entry.edit') }}"><i class="ti-more"></i>Marks Edit</a></li>
                    <li class="{{ $route == 'marks.entry.grade.view' ? 'active' : '' }}"><a href="{{ route('marks.entry.grade.view') }}"><i class="ti-more"></i>Marks Grade</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/accounts') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="inbox"></i> <span>Account Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'student.fee.view' ? 'active' : '' }}"><a href="{{ route('student.fee.view') }}"><i class="ti-more"></i>Student Fee</a></li>
                    <li class="{{ $route == 'account.salary.view' ? 'active' : '' }}"><a href="{{ route('account.salary.view') }}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li class="{{ $route == 'other.cost.view' ? 'active' : '' }}"><a href="{{ route('other.cost.view') }}"><i class="ti-more"></i>Other Cost</a></li>
                </ul>
            </li>
            <li class="header nav-small-cap">Report Interface</li>
            <li class="treeview {{ ($prefix == '/reports') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="server"></i> <span>Report Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'profit.view' ? 'active' : '' }}"><a href="{{ route('profit.view') }}"><i class="ti-more"></i>Monthly / Yearly Profit</a></li>
                    <li class="{{ $route == 'marksheet.generator.view' ? 'active' : '' }}"><a href="{{ route('marksheet.generator.view') }}"><i class="ti-more"></i>Marks Sheet Generator</a></li>
                    <li class="{{ $route == 'attendance.report.view' ? 'active' : '' }}"><a href="{{ route('attendance.report.view') }}"><i class="ti-more"></i>Attendance Report</a></li>
                    <li class="{{ $route == 'student.idcard.view' ? 'active' : '' }}"><a href="{{ route('student.idcard.view') }}"><i class="ti-more"></i>Student ID Card</a></li>
                    @if (Auth::user()->role === "Admin")
                    <li class="{{ $route == 'logs.view' ? 'active' : '' }}"><a href="{{ route('logs.view') }}" target="_blank"><i class="ti-more"></i>Open Logs</a></li>
                    @endif
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
