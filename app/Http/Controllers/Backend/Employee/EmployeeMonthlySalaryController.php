<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use PDF;

class EmployeeMonthlySalaryController extends Controller
{
    //
    public function MonthlySalaryView()
    {
        return view('backend.employee.emplyee_monthly_salary.view_emplyee_monthly_salary');
    }

    public function MonthlySalaryGet(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')
            ->groupBy('employee_id')
            ->with(['user'])
            ->where($where)
            ->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($data as $index => $attend) {
            $totalAtthend = EmployeeAttendance::with(['user'])
                ->where($where)
                ->where('employee_id', $attend->employee_id)
                ->get();
            $absent_count = count($totalAtthend->where('attend_status', 'Absent'));
            $html[$index]['tdsource']  = '<td>' . ($index + 1) . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $attend->user->name . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $attend->user->salary . '</td>';

            $salary = (float) $attend->user->salary;
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus = (float)$absent_count * (float)$salaryPerDay;
            $finalSalary = (float)$salary - (float)$totalSalaryMinus;
            //dd($salary, $salaryPerDay, $totalSalaryMinus, $finalSalary);

            $html[$index]['tdsource'] .= '<td>' . $finalSalary . '</td>';
            $html[$index]['tdsource'] .= '<td>';
            $html[$index]['tdsource'] .=
                '<a class="btn btn-sm btn-success" title="PaySlip" target="_blanks" href="' . route('employee.monthly.salary.payslip') . '?employee_id=' . $attend->employee_id . '&date=' . $request->date . '">Salary Slip</a>';
            $html[$index]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function MonthlySalaryPayslip(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        //$id = EmployeeAttendance::where('employee_id', $request->employee_id)->first();
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $data['details'] = EmployeeAttendance::with(['user'])
            ->where($where)
            ->where('employee_id', $request->employee_id)
            ->get();
        //dd($data['details'][0]['user']['name']);
        $pdf = PDF::loadView('backend.employee.emplyee_monthly_salary.payslip_emplyee_monthly_salary', $data)
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('a4', 'portrait');
        return view('backend.employee.emplyee_monthly_salary.payslip_emplyee_monthly_salary', $data);
        //return $pdf->download("registrantion_fee_" . $student_id . ".pdf");
    }
}
