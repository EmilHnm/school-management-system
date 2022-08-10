<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    //
    public function OtherCostView()
    {
        $data['allData'] = AccountOtherCost::all();
        return view('backend.account.other_cost.view_other_cost', $data);
    }

    public function OtherCostAdd()
    {
        return view('backend.account.other_cost.add_other_cost');
    }

    public function OtherCostStore(Request $request)
    {
        $request->validate([
            'date' => 'required|before_or_equal:today',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $data = new AccountOtherCost();
        $data->date = $request->date;
        $data->amount = $request->amount;
        $data->description = $request->description;

        if ($request->file('receipt_image')) {
            $file = $request->file('image');
            //@unlink(public_path('upload/student_images' . $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/student_images'), $filename);
            $data->image = $filename;
        }

        $data->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'Cost Added Successfully'
        );

        return redirect()->route('other.cost.view')->with($message);
    }

    public function OtherCostEdit($id)
    {
        $data['editData'] = AccountOtherCost::find($id);
        return view('backend.account.other_cost.edit_other_cost', $data);
    }

    public function OtherCostUpdate($id, Request $request)
    {
        $request->validate([
            'date' => 'required|before_or_equal:today',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $data = AccountOtherCost::find($id);
        $data->date = $request->date;
        $data->amount = $request->amount;
        $data->description = $request->description;

        if ($request->file('receipt_image')) {
            $file = $request->file('receipt_image');
            //dd($file);
            @unlink(public_path('upload/other_cost_images' . $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/other_cost_images'), $filename);
            $data->receipt_image = $filename;
        }

        $data->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'Cost Updated Successfully'
        );

        return redirect()->route('other.cost.view')->with($message);
    }
}
