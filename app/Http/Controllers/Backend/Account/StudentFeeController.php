<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    //
    public function StudentFeeView()
    {
        $data['allData'] = AccountStudentFee::all();

        return view('backend.account.student_fee.view_student_fee', $data);
    }
}
