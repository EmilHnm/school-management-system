<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    //

    public function StudentView()
    {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    public function StudentClassAdd()
    {
        return view('backend.setup.student_class.add_class');
    }

    public function StudentClassStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Class Added Successfully',
        );

        return redirect()->route('student.class.view')->with($message);
    }

    public function StudentClassEdit($id)
    {
        $editData = StudentClass::find($id);

        return view('backend.setup.student_class.edit_class', compact('editData'));
    }

    public function StudentClassUpdate(Request $request, $id)
    {
        $data = StudentClass::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name,'
        ]);

        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Class Updated Successfully',
        );

        return redirect()->route('student.class.view')->with($message);
    }

    public function StudentClassDelete($id)
    {
        $data = StudentClass::find($id);
        $data->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Class Deleted Successfully',
        );

        return redirect()->route('student.class.view')->with($message);
    }
}
