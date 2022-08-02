<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    //

    public function GetSubject(Request $request)
    {
        $data = AssignSubject::where('class_id', $request->class_id)
            ->with(['school_subject'])
            ->get();

        return response(json_encode($data));
    }
}
