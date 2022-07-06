<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{
    //
    public function DesignationView()
    {
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }

    public function DesignationAdd()
    {
        return view('backend.setup.designation.add_designation');
    }

    public function DesignationStore(Request $request)
    {
        $validateDate = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('designation.view')->with('success', 'Designation Added Successfully');
    }

    public function DesignationEdit($id)
    {
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));
    }

    public function DesignationUpdate(Request $request, $id)
    {
        $data = Designation::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:designations,name,',
        ]);
        $data->name = $request->name;
        $data->save();

        $messages = array(
            'alert-type' => 'success',
            'message' => 'Designation Updated Successfully',
        );

        return redirect()->route('designation.view')->with($messages);
    }

    public function DesignationDelete($id)
    {
        $data = Designation::find($id);
        $data->delete();
        $messages = array(
            'alert-type' => 'success',
            'message' => 'Designation Deleted Successfully',
        );
        return redirect()->route('designation.view')->with($messages);
    }
}
