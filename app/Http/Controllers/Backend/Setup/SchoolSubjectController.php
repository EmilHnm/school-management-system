<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    //
    public function SchoolSubjectView()
    {
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.school_subject_view', $data);
    }

    public function SchoolSubjectAdd()
    {
        return view('backend.setup.school_subject.school_subject_add');
    }

    public function SchoolSubjectStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $message =  array(
            'status' => 'success',
            'message' => 'School Subject Added Successfully'
        );
        return redirect()->route('school.subject.view')->with($message);
    }
    public function SchoolSubjectEdit($id)
    {
        $editData = SchoolSubject::find($id);

        return view('backend.setup.school_subject.school_subject_edit', compact('editData'));
    }
    public function SchoolSubjectUpdate(Request $request, $id)
    {
        $data = SchoolSubject::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'
        ]);
        $data->name = $request->name;
        $data->save();
        $message = array(
            'status' => 'success',
            'message' => 'School Subject Updated Successfully'
        );
        return redirect()->route('school.subject.view')->with($message);
    }

    public function SchoolSubjectDelete($id)
    {
        $data = SchoolSubject::find($id);
        $data->delete();
        $message = array(
            'status' => 'success',
            'message' => 'School Subject Deleted Successfully'
        );
        return redirect()->route('school.subject.view')->with($message);
    }
}
