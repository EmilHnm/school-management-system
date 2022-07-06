<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentYearController extends Controller
{
    //
    public function YearView()
    {
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    }

    public function StudentYearAdd()
    {
        return view('backend.setup.year.add_year');
    }

    public function StudentYearStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);
        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Year Added Successfully',
        );
        return redirect()->route('student.year.view')->with($message);
    }

    public function StudentYearEdit($id)
    {
        $editData = StudentYear::find($id);
        return view('backend.setup.year.edit_year', compact('editData'));
    }

    public function StudentYearUpdate(Request $request, $id)
    {
        $data = StudentYear::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Year Updated Successfully',
        );
        return redirect()->route('student.year.view')->with($message);
    }

    public function StudentYearDelete($id)
    {
        $data = StudentYear::find($id);
        $data->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Year Deleted Successfully',
        );
        return redirect()->route('student.year.view')->with($message);
    }
}
