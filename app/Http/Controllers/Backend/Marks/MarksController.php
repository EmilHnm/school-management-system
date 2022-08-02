<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\ExamType;
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
}
