<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryLog;
use App\Http\Controllers\Controller;

class EmployeeSalaryController extends Controller
{
    //

    public function SalaryView()
    {
        $data['allData'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_salary.view_employee_salary', $data);
    }


    public function SalaryIncrement($id)
    {
        $data['editData'] = User::find($id);

        return view('backend.employee.employee_salary.increament_employee_salary', $data);
    }

    public function SalaryUpdate($id, Request $request)
    {
        $validate = $request->validate([
            'increment_salary' => 'required',
            'effected_salary' => 'required',
        ]);
        $user = User::find($id);
        $previous_salary = $user->salary;
        $current_salary = (float) $previous_salary + (float) $request->increment_salary;
        //dd($previous_salary);
        $user->salary = $current_salary;
        $user->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->current_salary = $current_salary;
        $salaryData->increment_salary = $request->increment_salary;
        //dd($salaryData);
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'Salary Increment Successfully'
        );

        return redirect()->route('employee.salary.view')->with($message);
    }
}
