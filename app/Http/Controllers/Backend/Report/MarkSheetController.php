<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\ExamType;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use App\Models\StudentMarks;
use PDF;

class MarkSheetController extends Controller
{
    //
    public function MarkSheetView()
    {

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.report.mark_sheet.view_mark_sheet', $data);
    }

    public function MarkSheetGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $countFail = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->where('id_no', $id_no)
            ->where('marks', '<', '3.9')
            ->get()
            ->count();

        $studentData = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->where('id_no', $id_no)
            ->first();

        if ($studentData) {
            $allMarks = StudentMarks::with([
                'student', 'student_year'
            ])
                ->where('year_id', $year_id)
                ->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)
                ->where('id_no', $id_no)
                ->get();
            $data = $request->all();
            //dd($data);
            $allGrade = MarksGrade::all();
            return view('backend.report.mark_sheet.details_mark_sheet', compact('allGrade', 'allMarks', 'countFail', 'data'));
        } else {
            $message = array(
                'alert-type' => 'error',
                'message' => 'No data found'
            );
            return redirect()->back()->with($message);
        }
    }

    public function MarkSheetPrint(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $countFail = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->where('id_no', $id_no)
            ->where('marks', '<', '3.9')
            ->get()
            ->count();

        $studentData = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->where('id_no', $id_no)
            ->first();

        if ($studentData) {
            $allMarks = StudentMarks::with([
                'student', 'student_year'
            ])
                ->where('year_id', $year_id)
                ->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)
                ->where('id_no', $id_no)
                ->get();
            $allGrade = MarksGrade::all();
            $pdf = PDF::loadView('backend.report.mark_sheet.print_mark_sheet', compact('allGrade', 'allMarks', 'countFail'))
                ->setOptions(['defaultFont' => 'sans-serif'])
                ->setPaper('a3', 'portrait');

            return view('backend.report.mark_sheet.print_mark_sheet', compact('allGrade', 'allMarks', 'countFail'));
            //return $pdf->download("report_" . $id_no . '_' . date('Y-m-d') . ".pdf");
        } else {
            $message = array(
                'alert-type' => 'error',
                'message' => 'No data found'
            );
            return redirect()->back()->with($message);
        }
    }
}
