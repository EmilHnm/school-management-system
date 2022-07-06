<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentGroupController extends Controller
{
    //
    public function GroupView()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group', $data);
    }

    public function StudentGroupAdd()
    {
        return view('backend.setup.group.add_group');
    }

    public function StudentGroupStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Group Added Successfully',
        );

        return redirect()->route('student.group.view')->with($message);
    }

    public function StudentGroupEdit($id)
    {
        $editData = StudentGroup::find($id);
        return view('backend.setup.group.edit_group', compact('editData'));
    }

    public function StudentGroupUpdate(Request $request, $id)
    {
        $data = StudentGroup::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups,name,'
        ]);

        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Group Updated Successfully',
        );

        return redirect()->route('student.group.view')->with($message);
    }

    public function StudentGroupDelete($id)
    {
        $data = StudentGroup::find($id);
        $data->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Group Deleted Successfully',
        );

        return redirect()->route('student.group.view')->with($message);
    }
}
