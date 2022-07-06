<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeCategoryController extends Controller
{
    //
    public function FeeCategoryView()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_category', $data);
    }

    public function FeeCategoryAdd()
    {
        return view('backend.setup.fee_category.add_fee_category');
    }

    public function FeeCategoryStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Shift Added Successfully',
        );

        return redirect()->route('fee.category.view')->with($message);
    }

    public function FeeCategoryEdit($id)
    {
        $data['editData'] = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_category', $data);
    }

    public function FeeCategoryUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name,',
        ]);

        $data = FeeCategory::find($id);
        $data->name = $request->name;
        $data->save();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Shift Updated Successfully',
        );

        return redirect()->route('fee.category.view')->with($message);
    }
}
