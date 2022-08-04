<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //
    public function MarksGradeView()
    {
        $data['allData'] = MarksGrade::all();

        return view('backend.marks.view_grade_marks', $data);
    }

    public function MarksGradeAdd()
    {
        return view('backend.marks.add_grade_marks');
    }

    public function MarksGradeStore(Request $request)
    {
        $validateData = $request->validate([
            'grade_name' => 'required',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',
        ]);

        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'Marks Grade Added Successfully',
        );

        return redirect(route('marks.entry.grade.view'))->with($message);
    }

    public function MarksGradeEdit($id)
    {
        $data['editData'] = MarksGrade::find($id);

        return view('backend.marks.edit_grade_marks', $data);
    }

    public function MarksGradeUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'grade_name' => 'required',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',
        ]);

        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'Marks Grade Updated Successfully',
        );

        return redirect(route('marks.entry.grade.view'))->with($message);
    }
}
