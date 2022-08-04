<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentMarks;

class DefaultController extends Controller
{
    //

    public function GetSubject(Request $request)
    {
        $data = AssignSubject::where('class_id', $request->class_id)
            ->with(['school_subject'])
            ->get();

        return response(json_encode($data));
    }

    public function GetStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $data = AssignStudent::with(['student'])
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        return response(json_encode($data));
    }

    public function GetStudentMarks(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $data = StudentMarks::with(['student'])
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', $exam_type_id)
            ->get();
        return response(json_encode($data));
    }
}
