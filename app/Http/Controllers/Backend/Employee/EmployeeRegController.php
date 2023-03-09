<?php

namespace App\Http\Controllers\Backend\Employee;

// use PDF;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;

class EmployeeRegController extends Controller
{
    //
    public function EmployeeRegView()
    {
        $data['allData'] = User::where('usertype', 'Employee')->get();

        return view('backend.employee.employee_reg.view_employee_reg', $data);
    }

    public function EmployeeRegAdd()
    {
        $data['designations'] = Designation::all();
        return view('backend.employee.employee_reg.add_employee_reg', $data);
    }

    public function EmployeeRegStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'fname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'designation_id' => 'required',
            'salary' => 'required|numeric',
            'join_date' => 'required',
            'image' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $checkYear = date('Ym', strtotime($request->join_date));
            $employee = User::where('usertype', 'Employee')->orderBy('id', 'desc')->first();

            if ($employee == null) {
                $firstReg = 0;
                $employee_id = $firstReg + 1;
                if ($employee_id < 10) {
                    $id_no = '000' . $employee_id;
                } elseif ($employee_id < 100) {
                    $id_no = '00' . $employee_id;
                } elseif ($employee_id < 1000) {
                    $id_no = '0' . $employee_id;
                } else {
                    $id_no = $employee_id;
                }
            } else {
                $employee = User::where('usertype', 'Employee')->orderBy('id', 'desc')->first()->id;
                $employee_id = $employee + 1;
                if ($employee_id < 10) {
                    $id_no = '000' . $employee_id;
                } elseif ($employee_id < 100) {
                    $id_no = '00' . $employee_id;
                } elseif ($employee_id < 1000) {
                    $id_no = '0' . $employee_id;
                } else {
                    $id_no = $employee_id;
                }
            }
            $final_id_no = $checkYear . $id_no;

            //Add to User table
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->mname = $request->mname;
            $user->fname = $request->fname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->join_date = date('Y-m-d', strtotime($request->join_date));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'), $filename);
                $user->image = $filename;
            }
            $user->save();

            // Add to employee_salary_logs table
            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->current_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
        });

        $message = array(
            'message' => 'Employee Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.registration.view')->with($message);
    }

    public function EmployeeRegEdit($id)
    {
        $data['editData'] = User::find($id);
        $data['designations'] = Designation::all();
        return view('backend.employee.employee_reg.edit_employee_reg', $data);
    }

    public function EmployeeRegUpdate($id, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'fname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'designation_id' => 'required',
        ]);
        $employee = User::find($id);
        $employee->name = $request->name;
        $employee->mname = $request->mname;
        $employee->fname = $request->fname;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;
        $employee->gender = $request->gender;
        $employee->dob = $request->dob;
        $employee->designation_id = $request->designation_id;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/employee_images/' . $employee->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'), $filename);
            $employee->image = $filename;
        }
        $employee->save();

        $message = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.registration.view')->with($message);
    }

    public function EmployeeRegDetails($id)
    {
        $data['details'] = User::find($id);
        $data['designations'] = Designation::all();
        // dd($data);
        // $pdf = PDF::loadView('backend.employee.employee_reg.detail_employee_reg', $data)
        //     ->setOptions(['defaultFont' => 'sans-serif']);
        return view('backend.employee.employee_reg.detail_employee_reg', $data);
        //return $pdf->download('employee_detail_' . $id . '.pdf');
    }
}
