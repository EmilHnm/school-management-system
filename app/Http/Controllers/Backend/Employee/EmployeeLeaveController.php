<?php

namespace App\Http\Controllers\Backend\Employee;

use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Http\Controllers\Controller;

class EmployeeLeaveController extends Controller
{
    //

    public function LeaveView()
    {
        $data['allData'] = EmployeeLeave::orderBy('id', 'desc')->get();

        return view('backend.employee.employee_leave.view_employee_leave', $data);
    }

    public function LeaveAdd()
    {
        $data['employees'] = User::where('usertype', 'Employee')->get();
        $data['leave_purposes'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.add_employee_leave', $data);
    }

    public function LeaveStore(Request $request)
    {
        $validateData = $request->validate([
            'employee_id' => 'required',
            'leave_purposes_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);
        if ($request->leave_purposes_id == '0' && $request->add_another == '') {
            //dd($request);
            throw ValidationException::withMessages([
                'leave_purposes_id' => ['Please select fill leave purpose or add another.'],
            ]);
        }
        if ($request->leave_purposes_id == '0') {
            $leave_purpose = new LeavePurpose();
            $leave_purpose->name = $request->add_another;
            $leave_purpose->save();
            $leave_employees = new EmployeeLeave();
            $leave_employees->employee_id = $request->employee_id;
            $leave_employees->leave_purposes_id = $leave_purpose->id;
            $leave_employees->start_date = $request->start_date;
            $leave_employees->end_date = $request->end_date;
            $leave_employees->save();
        } else {
            $leave_employees = new EmployeeLeave();
            $leave_employees->employee_id = $request->employee_id;
            $leave_employees->leave_purposes_id = $request->leave_purposes_id;
            $leave_employees->start_date = $request->start_date;
            $leave_employees->end_date = $request->end_date;
            $leave_employees->save();
        }

        $message = array(
            'alert_type' => 'success',
            'message' => 'Leave Employees Added Successfully!',
        );

        return redirect()->route('employee.leave.view')->with($message);
    }

    public function LeaveEdit($id)
    {
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype', 'Employee')->get();
        $data['leave_purposes'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.edit_employee_leave', $data);
    }

    public function LeaveUpdate($id, Request $request)
    {
        $validateData = $request->validate([
            'leave_purposes_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);
        if ($request->leave_purposes_id == '0' && $request->add_another == '') {
            //dd($request);
            throw ValidationException::withMessages([
                'leave_purposes_id' => ['Please select fill leave purpose or add another.'],
            ]);
        }

        $leave_employees = EmployeeLeave::find($id);
        //dd($leave_employees);
        if ($request->leave_purposes_id == '0') {
            $leave_purpose = new LeavePurpose();
            $leave_purpose->name = $request->add_another;
            $leave_purpose->save();
            $leave_employees->leave_purposes_id = $leave_purpose->id;
            $leave_employees->start_date = $request->start_date;
            $leave_employees->end_date = $request->end_date;
            $leave_employees->save();
        } else {
            $leave_employees->leave_purposes_id = $request->leave_purposes_id;
            $leave_employees->start_date = $request->start_date;
            $leave_employees->end_date = $request->end_date;
            $leave_employees->save();
        }

        $message = array(
            'alert_type' => 'success',
            'message' => 'Leave Employees Updated Successfully!',
        );

        return redirect()->route('employee.leave.view')->with($message);
    }

    public function LeaveDelete($id)
    {
        $leave_employees = EmployeeLeave::find($id);
        $leave_employees->delete();
        $message = array(
            'alert_type' => 'success',
            'message' => 'Leave Employees Deleted Successfully!',
        );

        return redirect()->route('employee.leave.view')->with($message);
    }
}
