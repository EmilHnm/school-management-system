<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;

class EmployeeAttendanceController extends Controller
{
    //

    public function AttendanceView()
    {
        $data['allData'] = EmployeeAttendance::select('date')
            ->orderBy('date', 'Desc')
            ->groupBy('date')->get();
        return view('backend.employee.employee_attendance.view_employee_attendance', $data);
    }

    public function AttendanceAdd()
    {
        $data['employees'] = User::where('usertype', 'Employee')->get();

        return view('backend.employee.employee_attendance.add_employee_attendance', $data);
    }

    public function AttendanceStore(Request $request)
    {
        $validateData = $request->validate([
            'employee_id' => 'required',
            'date' => 'required',
        ]);
        $countEmployee = count($request->employee_id);

        for ($i = 0; $i < $countEmployee; $i++) {
            $attend_status = 'attend_status_' . $i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        $message = array(
            'alert-type' => 'success',
            'message' => 'Employee Attendance Data Added Successfully',
        );

        return redirect(route('employee.attendance.view'))->with($message);
    }

    public function AttendanceEdit($date)
    {
        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_attendance.edit_employee_attendance', $data);
    }

    public function AttendanceUpdate($date, Request $request)
    {
        $validateData = $request->validate([
            'employee_id' => 'required',
            'date' => 'required',
        ]);

        EmployeeAttendance::where('date', $date)->delete();

        $countEmployee = count($request->employee_id);

        for ($i = 0; $i < $countEmployee; $i++) {
            $attend_status = 'attend_status_' . $i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        $message = array(
            'alert-type' => 'success',
            'message' => 'Employee Attendance Data Updated Successfully',
        );

        return redirect(route('employee.attendance.view'))->with($message);
    }

    public function AttendanceDetails($date)
    {
        $data['details'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_attendance.details_employee_attendance', $data);
    }

    public function AttendanceDelete($date)
    {
        // dd($date);
        EmployeeAttendance::where('date', $date)->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Employee Attendance Data Deleted Successfully',
        );

        return redirect(route('employee.attendance.view'))->with($message);
    }
}
