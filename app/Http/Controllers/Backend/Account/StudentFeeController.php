<?php

namespace App\Http\Controllers\Backend\Account;

use App\Models\User;
use App\Models\FeeCategory;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\AccountStudentFee;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    //
    public function StudentFeeView()
    {
        $data['allData'] = AccountStudentFee::with(['student'])->get();
        return view('backend.account.student_fee.view_student_fee', $data);
    }

    public function StudentFeeAdd()
    {
        $data['student'] = User::where('usertype', 'Student')->get();
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();

        return view('backend.account.student_fee.add_student_fee', $data);
    }

    public function StudentFeeGetStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));

        $data = AssignStudent::with(['discount'])
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $index => $item) {
            $registrationFee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                ->where('class_id', $class_id)->first();
            //dd($registrationFee->amount, $class_id, $fee_category_id);
            $accountStudentFee = AccountStudentFee::where('student_id', $item->student_id)
                ->where('class_id', $item->class_id)
                ->where('year_id', $item->year_id)
                ->where('fee_category_id', $fee_category_id)
                ->where('date', $date)
                ->first();
            // dd($accountStudentFee);
            if ($accountStudentFee) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            //dd($checked);

            $html[$index]['tdsource']  = '<td>' . ($index + 1) .
                '<input type="hidden" name="fee_category_id" value="' . $fee_category_id . '">' . '</td>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>' . $item->student->name .
                '<input type="hidden" name="year_id" value="' . $item->year_id . '">' . '</td>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>' . $item->student->id_no .
                '<input type="hidden" name="class_id" value="' . $item->class_id . '">' . '</td>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>' . $registrationFee->amount .
                '<input type="hidden" name="date" value="' . $date . '">' . '</td>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>' . $item->discount->discount . '%</td>';

            $originalFee = $registrationFee->amount;
            $discount = $item->discount->discount;
            $discountableFee = $discount / 100 * $originalFee;
            $finalFee = (int)$originalFee - (int)$discountableFee;

            $html[$index]['tdsource'] .= '<td>' .
                '<input type="text" name="account[]" value="' . $finalFee . '" class="form-control" readonly>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>';
            $html[$index]['tdsource'] .=
                '<input type="hidden" name="student_id[]" value="' . $item->student_id . '">' .
                '<input type="checkbox" name="checkmanage[]" id=id_' . $index . '" value="' . $index . '" ' . $checked . ' style="transform: scale(1.5); margin-left: 10px">' .
                '<label for="id_' . $index . '"></label>';
            $html[$index]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function StudentFeeStore(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        AccountStudentFee::where('year_id', $request->year_id)
            ->where('class_id', $request->class_id)
            ->where('fee_category_id', $request->fee_category_id)
            ->where('date', $date)
            ->delete();
        $checkData = $request->checkmanage;
        if ($checkData) {
            for ($i = 0; $i < count($checkData); $i++) {
                $data = new AccountStudentFee();
                $data->date = $date;
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkData[$i]];
                $data->amount = $request->account[$checkData[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkData)) {
            $message = array(
                'message' => 'Data Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('student.fee.view')->with($message);
        } else {
            $message = array(
                'message' => 'Data Not Updated',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
    }
}
