<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentShiftController extends Controller
{
    //
    public function ShiftView()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift', $data);
    }

    public function StudentShiftAdd()
    {
        return view('backend.setup.shift.add_shift');
    }

    public function StudentShiftStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Shift Added Successfully',
        );

        return redirect()->route('student.shift.view')->with($message);
    }

    public function StudentShiftEdit($id)
    {
        $data['editData'] = StudentShift::find($id);
        return view('backend.setup.shift.edit_shift', $data);
    }

    public function StudentShiftUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts,name,' . $id,
        ]);

        $data = StudentShift::find($id);
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Shift Updated Successfully',
        );

        return redirect()->route('student.shift.view')->with($message);
    }

    public function StudentShiftDelete($id)
    {
        $data = StudentShift::find($id);
        $data->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Shift Deleted Successfully',
        );

        return redirect()->route('student.shift.view')->with($message);
    }
}
