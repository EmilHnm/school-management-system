<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\StudentFaculty;
use App\Http\Controllers\Controller;

class StudentFacultyController extends Controller
{
    //
    public function StudentFacultyView()
    {
        $data['allData'] = StudentFaculty::all();
        return view('backend.setup.student_faculty.view_faculty', $data);
    }

    public function StudentFacultyAdd()
    {
        return view('backend.setup.student_faculty.add_faculty');
    }

    public function StudentFacultyStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_faculties,name',
        ]);

        $data = new StudentFaculty();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Faculty Added Successfully',
        );

        return redirect()->route('student.faculty.view')->with($message);
    }

    public function StudentFacultyEdit($id)
    {
        $editData = StudentFaculty::find($id);
        return view('backend.setup.student_faculty.edit_faculty', compact('editData'));
    }

    public function StudentFacultyUpdate(Request $request, $id)
    {
        $data = StudentFaculty::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_faculties,name,'
        ]);

        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Faculty Updated Successfully',
        );

        return redirect()->route('student.faculty.view')->with($message);
    }

    public function StudentFacultyDelete($id)
    {
        $data = StudentFaculty::find($id);
        $data->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Faculty Deleted Successfully',
        );

        return redirect()->route('student.faculty.view')->with($message);
    }
}
