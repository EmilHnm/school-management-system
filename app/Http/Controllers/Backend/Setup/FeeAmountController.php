<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class FeeAmountController extends Controller
{
    //
    public function FeeAmountView()
    {
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')
            ->groupBy('fee_category_id')
            ->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    public function FeeAmountAdd()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    public function FeeAmountStore(Request $requets)
    {
        $countClass = count($requets->class_id);
        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $requets->fee_category_id;
                $fee_amount->class_id = $requets->class_id[$i];
                $fee_amount->amount = $requets->amount[$i];
                $fee_amount->save();
            }
        }
        $message = array(
            'alert-type' => 'success',
            'message' => 'Fee Amount Added Successfully',
        );

        return redirect()->route('fee.amount.view')->with($message);
    }

    public function FeeAmountEdit($id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $id)
            ->orderBy('class_id', 'asc')->get();
        // dd($data['edit']->toArray());
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    public function FeeAmountUpdate(Request $request, $id)
    {
        if ($request->class_id != NULL) {
            FeeCategoryAmount::where('fee_category_id', $id)->delete();
            $countClass = count($request->class_id);
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
            $message = array(
                'alert-type' => 'success',
                'message' => 'Fee Amount Updated Successfully',
            );
            return redirect()->route('fee.amount.view')->with($message);
        }
    }

    public function FeeAmountDetail($id)
    {
        $data['detail'] = FeeCategoryAmount::where('fee_category_id', $id)
            ->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.detail_fee_amount', $data);
    }
}
