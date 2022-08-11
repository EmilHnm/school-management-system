<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Report\StudentResultController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Report\AttendanceReportController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeMonthlySalaryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['prevent_back_history']], function () {



    Route::get('/', function () {
        return view('auth.login');
    })->middleware('guest');

    Route::middleware([
        'auth'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('dashboard');
    });

    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');



    // User management routes
    Route::middleware(['auth', 'auth.admin_role'])->prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
        Route::get('/add', [UserController::class, 'UserAdd'])->name('user.add');
        Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');
    });

    // Profile management routes
    Route::middleware('auth')->prefix('profiles')->group(function () {
        Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
        Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
        Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
        Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
    });

    Route::middleware('auth')->prefix('setup')->group(function () {
        // Student class routes
        Route::get('student/class/view', [StudentClassController::class, 'StudentView'])->name('student.class.view');
        Route::get('student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');
        Route::post('student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('student.class.store');
        Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
        Route::post('student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('student.class.update');
        Route::get('student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');
        // Student year routes
        Route::get('student/year/view', [StudentYearController::class, 'YearView'])->name('student.year.view');
        Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');
        Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('student.year.store');
        Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
        Route::post('student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('student.year.update');
        Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');
        // Student group routes
        Route::get('student/group/view', [StudentGroupController::class, 'GroupView'])->name('student.group.view');
        Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');
        Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('student.group.store');
        Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
        Route::post('student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('student.group.update');
        Route::get('student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');
        // Student shift routes
        Route::get('student/shift/view', [StudentShiftController::class, 'ShiftView'])->name('student.shift.view');
        Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');
        Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('student.shift.store');
        Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');
        Route::post('student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('student.shift.update');
        Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');
        //Fee Category Route
        Route::get('fee/category/view', [FeeCategoryController::class, 'FeeCategoryView'])->name('fee.category.view');
        Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCategoryAdd'])->name('fee.category.add');
        Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCategoryStore'])->name('fee.category.store');
        Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCategoryEdit'])->name('fee.category.edit');
        Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCategoryUpdate'])->name('fee.category.update');
        Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');
        //Fee Category Amount Route
        Route::get('fee/amount/view', [FeeAmountController::class, 'FeeAmountView'])->name('fee.amount.view');
        Route::get('fee/amount/add', [FeeAmountController::class, 'FeeAmountAdd'])->name('fee.amount.add');
        Route::post('fee/amount/store', [FeeAmountController::class, 'FeeAmountStore'])->name('fee.amount.store');
        Route::get('fee/amount/edit/{id}', [FeeAmountController::class, 'FeeAmountEdit'])->name('fee.amount.edit');
        Route::post('fee/amount/update/{id}', [FeeAmountController::class, 'FeeAmountUpdate'])->name('fee.amount.update');
        Route::get('fee/amount/detail/{id}', [FeeAmountController::class, 'FeeAmountDetail'])->name('fee.amount.detail');
        //Exam Type Route
        Route::get('exam/type/view', [ExamTypeController::class, 'ExamTypeView'])->name('exam.type.view');
        Route::get('exam/type/add', [ExamTypeController::class, 'ExamTypeAdd'])->name('exam.type.add');
        Route::post('exam/type/store', [ExamTypeController::class, 'ExamTypeStore'])->name('exam.type.store');
        Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
        Route::post('exam/type/update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('exam.type.update');
        Route::get('exam/category/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');
        //School Subject Route
        Route::get('school/subject/view', [SchoolSubjectController::class, 'SchoolSubjectView'])->name('school.subject.view');
        Route::get('school/subject/add', [SchoolSubjectController::class, 'SchoolSubjectAdd'])->name('school.subject.add');
        Route::post('school/subject/store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('school.subject.store');
        Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');
        Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('school.subject.update');
        Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');
        //School Subject Route
        Route::get('assign/subject/view', [AssignSubjectController::class, 'AssignSubjectView'])->name('assign.subject.view');
        Route::get('assign/subject/add', [AssignSubjectController::class, 'AssignSubjectAdd'])->name('assign.subject.add');
        Route::post('assign/subject/store', [AssignSubjectController::class, 'AssignSubjectStore'])->name('assign.subject.store');
        Route::get('assign/subject/edit/{id}', [AssignSubjectController::class, 'AssignSubjectEdit'])->name('assign.subject.edit');
        Route::post('assign/subject/update/{id}', [AssignSubjectController::class, 'AssignSubjectUpdate'])->name('assign.subject.update');
        Route::get('assign/subject/detail/{id}', [AssignSubjectController::class, 'AssignSubjectDetail'])->name('assign.subject.detail');
        Route::get('assign/subject/delete/{id}', [AssignSubjectController::class, 'AssignSubjectDelete'])->name('assign.subject.delete');
        //Designation Route
        Route::get('designation/view', [DesignationController::class, 'DesignationView'])->name('designation.view');
        Route::get('designation/add', [DesignationController::class, 'DesignationAdd'])->name('designation.add');
        Route::post('designation/store', [DesignationController::class, 'DesignationStore'])->name('designation.store');
        Route::get('designation/edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');
        Route::post('designation/update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('designation.update');
        Route::get('designation/delete/{id}', [DesignationController::class, 'DesignationDelete'])->name('designation.delete');
    });

    Route::middleware('auth')->prefix('students')->group(function () {
        //Registration Route
        Route::get('reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');
        Route::get('reg/add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');
        Route::post('reg/store', [StudentRegController::class, 'StudentRegStore'])->name('student.registration.store');
        Route::get('year/class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');
        Route::get('reg/edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');
        Route::post('reg/update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('student.registration.update');
        Route::get('reg/promotion/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');
        Route::post('reg/update/promotion/{student_id}', [StudentRegController::class, 'StudentUpdatePromotion'])->name('promotion.student.registration');
        Route::get('reg/details/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');
        //Roll Generate Route
        Route::get('roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');
        Route::post('roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');
        Route::get('reg/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');
        //Registrantion Fee Route
        Route::get('reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');
        Route::get('reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');
        Route::get('reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePaySlip'])->name('student.registration.fee.payslip');
        //Monthly Fee Route
        Route::get('monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');
        Route::get('monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');
        Route::get('monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePaySlip'])->name('student.monthly.fee.payslip');
        //Exam Fee Route
        Route::get('exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');
        Route::get('exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');
        Route::get('monthly/fee/payslip', [ExamFeeController::class, 'ExamFeePaySlip'])->name('student.exam.fee.payslip');
    });


    Route::middleware('auth')->prefix('employees')->group(function () {
        //Registration Route
        Route::get('reg/view', [EmployeeRegController::class, 'EmployeeRegView'])->name('employee.registration.view');
        Route::get('reg/add', [EmployeeRegController::class, 'EmployeeRegAdd'])->name('employee.registration.add');
        Route::post('reg/store', [EmployeeRegController::class, 'EmployeeRegStore'])->name('employee.registration.store');
        Route::get('reg/edit/{id}', [EmployeeRegController::class, 'EmployeeRegEdit'])->name('employee.registration.edit');
        Route::post('reg/update/{id}', [EmployeeRegController::class, 'EmployeeRegUpdate'])->name('employee.registration.update');
        Route::get('reg/details/{id}', [EmployeeRegController::class, 'EmployeeRegDetails'])->name('employee.registration.details');
        //Salary Route
        Route::get('salary/view', [EmployeeSalaryController::class, 'SalaryView'])->name('employee.salary.view');
        Route::get('salary/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');
        Route::post('salary/increment/update/{id}', [EmployeeSalaryController::class, 'SalaryUpdate'])->name('employee.salary.increament.update');
        //Leave Route
        Route::get('leave/view', [EmployeeLeaveController::class, 'LeaveView'])->name('employee.leave.view');
        Route::get('leave/add', [EmployeeLeaveController::class, 'LeaveAdd'])->name('employee.leave.add');
        Route::post('leave/store', [EmployeeLeaveController::class, 'LeaveStore'])->name('employee.leave.store');
        Route::get('leave/edit/{id}', [EmployeeLeaveController::class, 'LeaveEdit'])->name('employee.leave.edit');
        Route::post('leave/update/{id}', [EmployeeLeaveController::class, 'LeaveUpdate'])->name('employee.leave.update');
        Route::get('leave/delete/{id}', [EmployeeLeaveController::class, 'LeaveDelete'])->name('employee.leave.delete');
        //Attendance Route
        Route::get('attendance/view', [EmployeeAttendanceController::class, 'AttendanceView'])->name('employee.attendance.view');
        Route::get('attendance/add', [EmployeeAttendanceController::class, 'AttendanceAdd'])->name('employee.attendance.add');
        Route::post('attendance/store', [EmployeeAttendanceController::class, 'AttendanceStore'])->name('employee.attendance.store');
        Route::get('attendance/edit/{date}', [EmployeeAttendanceController::class, 'AttendanceEdit'])->name('employee.attendance.edit');
        Route::post('attendance/update/{date}', [EmployeeAttendanceController::class, 'AttendanceUpdate'])->name('employee.attendance.update');
        Route::get('attendance/details/{date}', [EmployeeAttendanceController::class, 'AttendanceDetails'])->name('employee.attendance.details');
        Route::get('attendance/delete/{date}', [EmployeeAttendanceController::class, 'AttendanceDelete'])->name('employee.attendance.delete');
        //MOnthly Salary Route
        Route::get('monthly/salary/view', [EmployeeMonthlySalaryController::class, 'MonthlySalaryView'])->name('employee.monthly.salary.view');
        Route::get('monthly/salary/get', [EmployeeMonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');
        Route::get('monthly/salary/payslip', [EmployeeMonthlySalaryController::class, 'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
    });

    Route::middleware('auth')->prefix('marks')->group(function () {
        Route::get('entry/add', [MarksController::class, 'MarksAdd'])->name('marks.entry.add');
        Route::post('entry/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store');
        Route::get('entry/edit', [MarksController::class, 'MarksEdit'])->name('marks.entry.edit');
        Route::post('entry/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');
        Route::get('entry/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');
        Route::get('entry/getstudent', [DefaultController::class, 'GetStudent'])->name('marks.getstudents');
        Route::get('entry/edit/getstudent', [DefaultController::class, 'GetStudentMarks'])->name('marks.edit.getstudents');

        Route::get('entry/grade/view', [GradeController::class, 'MarksGradeView'])->name('marks.entry.grade.view');
        Route::get('entry/grade/add', [GradeController::class, 'MarksGradeAdd'])->name('marks.entry.grade.add');
        Route::get('entry/grade/edit/{id}', [GradeController::class, 'MarksGradeEdit'])->name('marks.entry.grade.edit');
        Route::post('entry/grade/store', [GradeController::class, 'MarksGradeStore'])->name('marks.entry.grade.store');
        Route::post('entry/grade/update/{id}', [GradeController::class, 'MarksGradeUpdate'])->name('marks.entry.grade.update');
    });

    Route::middleware('auth')->prefix('accounts')->group(function () {
        // Student Fee Routes
        Route::get('student/fee/view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');
        Route::get('student/fee/add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');
        Route::get('student/fee/getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('student.fee.getstudent');
        Route::post('student/fee/store', [StudentFeeController::class, 'StudentFeeStore'])->name('student.fee.store');
        // Student Fee Routes
        Route::get('account/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');
        Route::get('account/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');
        Route::get('account/salary/getemployee', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');
        Route::post('account/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');
        // Other Cost Routes
        Route::get('other/cost/view', [OtherCostController::class, 'OtherCostView'])->name('other.cost.view');
        Route::get('other/cost/add', [OtherCostController::class, 'OtherCostAdd'])->name('other.cost.add');
        Route::post('other/cost/store', [OtherCostController::class, 'OtherCostStore'])->name('other.cost.store');
        Route::get('other/cost/edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('other.cost.edit');
        Route::post('other/cost/update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('other.cost.update');
    });

    // Reports management routes
    Route::middleware(['auth'])->prefix('reports')->group(function () {
        // Profit Routes
        Route::get('profit/view', [ProfitController::class, 'ProfitView'])->name('profit.view');
        Route::get('profit/date/get', [ProfitController::class, 'ProfitDateGet'])->name('profit.date.get');
        Route::get('profit/details', [ProfitController::class, 'ProfitDetails'])->name('profit.details');
        // Profit Routes
        Route::get('attendance/report/view', [AttendanceReportController::class, 'AttendReportView'])->name('attendance.report.view');
        Route::get('attendance/report/get', [AttendanceReportController::class, 'AttendReportGet'])->name('report.attendance.get');
        // Profit Routes
        Route::get('marksheet/generator/view', [MarkSheetController::class, 'MarkSheetView'])->name('marksheet.generator.view');
        Route::get('marksheet/generator/get', [MarkSheetController::class, 'MarkSheetGet'])->name('marksheet.generator.get');
        Route::get('marksheet/generator/print', [MarkSheetController::class, 'MarkSheetPrint'])->name('marksheet.generator.print');
        // Profit Routes
        Route::get('student/idcard/view', [StudentRegController::class, 'IdCardView'])->name('student.idcard.view');
        Route::get('student/idcard/get', [StudentRegController::class, 'IdCardGet'])->name('report.student.idcard.get');
    });
});
