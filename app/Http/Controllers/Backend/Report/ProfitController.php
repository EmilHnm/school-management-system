<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use PDF;

class ProfitController extends Controller
{
    //

    public function ProfitView()
    {
        return view('backend.report.profit.view_profit');
    }

    public function ProfitDateGet(Request $request)
    {
        $start_month = date('Y-m', strtotime($request->start_date));
        $end_month = date('Y-m', strtotime($request->end_date));
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_month, $end_month])->sum('amount');
        $employee_salary = AccountEmployeeSalary::whereBetween('date', [$start_month, $end_month])->sum('amount');
        $other_costs = AccountOtherCost::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $totalCost = $employee_salary + $other_costs;
        $profit = $student_fee - $totalCost;

        //dd($totalCost, $employee_salary, $other_costs);

        $html['thsource'] = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';


        $html['tdsource']  = '<td>' . $student_fee . '</td>';
        $html['tdsource'] .= '<td>' . $other_costs . '</td>';
        $html['tdsource'] .= '<td>' . $employee_salary . '</td>';
        $html['tdsource'] .= '<td>' . $totalCost . '</td>';
        $html['tdsource'] .= '<td>' . $profit . '</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .=
            '<a class="btn btn-sm btn-success" title="PDF" target="_blanks" href="' . route('profit.details') . '?start_date=' . $start_date . '&end_date=' . $end_date . '">Details</a>';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }

    public function ProfitDetails(Request $request)
    {
        $data['start_month'] = date('Y-m', strtotime($request->start_date));
        $data['end_month'] = date('Y-m', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('backend.report.profit.details_profit', $data)
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('a3', 'portrait');
        //return view('backend.report.profit.details_profit', $data);
        return $pdf->download("report_" . date('Y-m-d') . ".pdf");
    }
}
