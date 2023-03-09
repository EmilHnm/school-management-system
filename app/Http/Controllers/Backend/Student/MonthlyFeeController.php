<?php

namespace App\Http\Controllers\Backend\Student;

// use PDF;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class MonthlyFeeController extends Controller
{
    //

    public function MonthlyFeeView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.monthly_fee.view_monthly_fee', $data);
    }

    public function MonthlyFeeClassData(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $month = $request->month;
        if ($year_id != '') {
            $where[] = ['year_id', 'like', $year_id . '%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }
        if ($month != '') {
        }

        $allStudent = AssignStudent::with(['discount'])
            ->where($where)
            ->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount</th>';
        $html['thsource'] .= '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudent as $index => $student) {
            $registrantion_fee = FeeCategoryAmount::where('fee_category_id', 2)
                ->where('class_id', $student->class_id)
                ->first();
            //dd($registrantion_fee);
            $html[$index]['tdsource'] = '<td>' . ($index + 1) . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $student->student->id_no . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $student->student->name . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $student->roll . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $registrantion_fee->amount . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $student->discount->discount . '%</td>';

            $originalFee = $registrantion_fee->amount;
            $discount = $student->discount->discount;
            $discountTableFee = $discount / 100 * $originalFee;
            $finalFee = (float)$originalFee - (float)$discountTableFee;

            $html[$index]['tdsource'] .= '<td>' . $finalFee . '</td>';
            $html[$index]['tdsource'] .= '<td>';
            $html[$index]['tdsource'] .=
                '<a class="btn btn-sm btn-success" title="PaySlip" target="_blanks" href="' . route('student.monthly.fee.payslip') . '?class_id=' . $student->class_id . '&student_id=' . $student->student_id . '&month=' . $month . '">Fee Slip</a>';
            $html[$index]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function MonthlyFeePaySlip(Request $request)
    {
        $class_id = $request->class_id;
        $student_id = $request->student_id;
        $data['month'] = $request->month;
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['editData'] = AssignStudent::with(['student', 'discount'])
            ->where('class_id', $class_id)
            ->where('student_id', $student_id)
            ->first();
        $data['assigns_student'] = AssignStudent::where('student_id', $student_id)->get();




        // $pdf = PDF::loadView('backend.student.monthly_fee.detail_monthly_fee', $data)
        //     ->setOptions(['defaultFont' => 'sans-serif']);
        return view('backend.student.monthly_fee.detail_monthly_fee', $data);
        //return $pdf->download("registrantion_fee_" . $student_id . ".pdf");
    }
}
