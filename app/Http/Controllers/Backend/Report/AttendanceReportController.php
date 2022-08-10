<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use PDF;

class AttendanceReportController extends Controller
{
    //
    public function AttendReportView()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.report.attendance_report.view_attendance_report', $data);
    }

    public function AttendReportGet(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'date' => 'required',
        ]);
        $employee_id = $request->employee_id;
        $date = date('Y-m', strtotime($request->date));
        $data['attendance'] = EmployeeAttendance::with(['user'])
            ->find($employee_id)
            ->where('date', 'like',  $date . '%')
            ->get();
        if ($data['attendance']) {
            $data['absents'] = EmployeeAttendance::with(['user'])
                ->find($employee_id)
                ->where('date', 'like',  $date . '%')
                ->where('attend_status', 'Absent')
                ->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['user'])
                ->find($employee_id)
                ->where('date', 'like',  $date . '%')
                ->where('attend_status', 'Leave')
                ->get()->count();
            $data['month'] = date('Y-m', strtotime($request->date));
            $pdf = PDF::loadView('backend.report.attendance_report.details_attendance_report', $data)
                ->setOptions(['defaultFont' => 'sans-serif'])
                ->setPaper('a3', 'portrait');
            return view('backend.report.attendance_report.details_attendance_report', $data);
            //return $pdf->download("report_" . date('Y-m-d') . ".pdf");
        } else {
            $message = array(
                'alert-type' => 'error',
                'message' => 'No data found!'
            );
            return redirect()->back()->with($message);
        }
    }
}
