<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;

class AccountSalaryController extends Controller
{
    //

    public function AccountSalaryView()
    {
        $data['allData'] = AccountEmployeeSalary::all();

        return view('backend.account.employee_salary.view_employee_salary', $data);
    }

    public function AccountSalaryAdd()
    {
        return view('backend.account.employee_salary.add_employee_salary');
    }

    public function AccountSalaryGetEmployee(request $request)
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
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $index => $attend) {
            $accountSalary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)
                ->where('date', $date)
                ->first();
            if ($accountSalary) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            $totalAtthend = EmployeeAttendance::with(['user'])
                ->where($where)
                ->where('employee_id', $attend->employee_id)
                ->get();
            $absent_count = count($totalAtthend->where('attend_status', 'Absent'));
            $html[$index]['tdsource']  = '<td>' . ($index + 1) . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $attend->user->id_no .
                '<input type="hidden" name="date" value="' . $date . '">' . '</td>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>' . $attend->user->name . '</td>';
            $html[$index]['tdsource'] .= '<td>' . $attend->user->salary . '</td>';

            $salary = (float) $attend->user->salary;
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus = (float)$absent_count * (float)$salaryPerDay;
            $finalSalary = (float)$salary - (float)$totalSalaryMinus;
            //dd($salary, $salaryPerDay, $totalSalaryMinus, $finalSalary);

            $html[$index]['tdsource'] .= '<td>' .
                '<input type="text" name="amount[]" value="' . $finalSalary . '" class="form-control" readonly>' .
                '</td>';
            $html[$index]['tdsource'] .= '<td>';
            $html[$index]['tdsource'] .=
                '<input type="hidden" name="employee_id[]" value="' . $attend->employee_id . '">' .
                '<input type="checkbox" name="checkmanage[]" id="id_' . $index  . '" value="' . $index . '" ' . $checked . ' style="transform: scale(1.5); margin-left: 10px">' .
                '<label for="id_' . $index  . '"></label> </label>';
            $html[$index]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function AccountSalaryStore(Request $request)
    {
        //dd($request->all());
        $date = date('Y-m', strtotime($request->date));

        AccountEmployeeSalary::where('date', $date)->delete();
        $checkData = $request->checkmanage;
        if ($checkData) {
            for ($i = 0; $i < count($checkData); $i++) {
                $data = new AccountEmployeeSalary();
                $data->date = $date;
                $data->employee_id = $request->employee_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkData)) {
            $message = array(
                'message' => 'Data Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('account.salary.view')->with($message);
        } else {
            $message = array(
                'message' => 'Data Not Updated',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
    }
}
