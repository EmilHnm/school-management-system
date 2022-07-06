<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function UserView()
    {
        // $allData = User::all();
        $data['allData'] = User::all();
        return view('backend.user.view_user', $data);
    }

    public function UserAdd()
    {
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request)
    {
        $validatedData  = $request->validate([
            'usertype' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->usertype = $request->usertype;
        $data->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'User Added Successfully',
        );

        return redirect()->route('user.view')->with($message);
    }

    public function UserEdit($id)
    {
        $editData = User::find($id);
        //dd(view('backend.user.edit_user', compact('editData')));
        return view('backend.user.edit_user',  compact('editData'));
    }

    public function UserUpdate(Request $request, $id)
    {
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->usertype = $request->usertype;
        $data->save();

        $message = array(
            'alert-type' => 'info',
            'message' => 'User Updated Successfully',
        );

        return redirect()->route('user.view')->with($message);
    }

    public function UserDelete($id)
    {
        $user = User::find($id);
        $user->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'User Deleted Successfully',
        );

        return redirect()->route('user.view')->with($message);
    }
}
