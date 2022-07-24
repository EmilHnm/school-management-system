<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;

class StudentRollController extends Controller
{
    //

    public function StudentRollView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();


        $data['groups'] = StudentGroup::all();

        return view('backend.student.roll_generate.view_roll_generate', $data);
    }

    public function GetStudents(Request $request)
    {
        $allData = AssignStudent::with(['student'])
            ->where('class_id', $request->class_id)
            ->where('year_id', $request->year_id)
            ->get()
            ->toArray();
        return response()->json($allData);
    }

    public function StudentRollStore(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id  != null) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                if ($request->roll[$i] != 'null') {
                    $student = AssignStudent::where('student_id', $request->student_id[$i])
                        ->where('class_id', $class_id)
                        ->where('year_id', $year_id)
                        ->first();
                    $student->roll = $request->roll[$i];
                    $student->save();
                } else {
                    $message = array(
                        'type' => 'error',
                        'message' => 'Cannot set null in roll',
                    );
                    return redirect()->back()->with($message);
                }
            }
            $message = array(
                'type' => 'success',
                'message' => 'Roll Generated Successfully'
            );
            return redirect()->route('roll.generate.view')->with($message);
        }
        $message = array(
            'type' => 'error',
            'message' => 'There are no student'
        );
        return redirect()->back()->with($message);
    }
}
