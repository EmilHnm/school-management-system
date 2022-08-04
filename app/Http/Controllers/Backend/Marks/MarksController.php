<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\StudentMarks;
use GuzzleHttp\Psr7\Response;

class MarksController extends Controller
{
    //
    public function MarksAdd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.marks.add_marks', $data);
    }

    public function MarksStore(Request $request)
    {
        $validateData = $request->validate([
            'class_id' => 'required',
            'year_id' => 'required',
            'exam_type_id' => 'required',
            'assign_subject_id' => 'required',
            'student_id.*' => 'required',
            'id_no.*' => 'required',
            'marks.*' => 'required|numeric|min:0|max:10',
        ]);

        $studentCount = count($request->student_id);
        if ($studentCount > 0) {
            for ($i = 0; $i < $studentCount; $i++) {
                $marks = new StudentMarks();
                $marks->year_id = $request->year_id;
                $marks->class_id = $request->class_id;
                $marks->assign_subject_id = $request->assign_subject_id;
                $marks->exam_type_id = $request->exam_type_id;
                $marks->student_id = $request->student_id[$i];
                $marks->marks = $request->marks[$i];
                $marks->id_no = $request->id_no[$i];
                $marks->save();
            }
            $message = array(
                'alert-type' => 'success',
                'message' => 'Marks Addded Successfully'
            );
            return redirect()->back()->with($message);
        } else {
            $message = array(
                'alert-type' => 'error',
                'message' => 'There are no student'
            );
            return redirect()->back()->with($message);
        }
    }

    public function MarksEdit()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.marks.edit_marks', $data);
    }


    public function MarksUpdate(Request $request)
    {

        $validateData = $request->validate([
            'id.*' => 'required',
            'marks.*' => 'required|numeric|min:0|max:10',
        ]);

        $studentCount = count($request->id);
        if ($studentCount > 0) {
            for ($i = 0; $i < $studentCount; $i++) {
                $marks = StudentMarks::find($request->id[$i]);
                $marks->marks = $request->marks[$i];
                $marks->save();
            }
            $message = array(
                'alert-type' => 'success',
                'message' => 'Marks Updated Successfully'
            );
            return redirect()->back()->with($message);
        } else {
            $message = array(
                'alert-type' => 'error',
                'message' => 'There are no student'
            );
            return redirect()->back()->with($message);
        }
    }
}
