<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\ExamType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamTypeController extends Controller
{
    //
    public function ExamTypeView()
    {
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }

    public function ExamTypeAdd()
    {
        return view('backend.setup.exam_type.add_exam_type');
    }

    public function ExamTypeStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Exam Type Added Successfully',
        );

        return redirect()->route('exam.type.view')->with($message);
    }
    public function ExamTypeEdit(Request $request, $id)
    {
        $editData = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('editData'));
    }

    public function ExamTypeUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data = ExamType::find($id);
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Exam Type Updated Successfully',
        );

        return redirect()->route('exam.type.view')->with($message);
    }

    public function ExamTypeDelete($id)
    {
        $data = ExamType::find($id);
        $data->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Exam Type Deleted Successfully',
        );

        return redirect()->route('exam.type.view')->with($message);
    }
}
