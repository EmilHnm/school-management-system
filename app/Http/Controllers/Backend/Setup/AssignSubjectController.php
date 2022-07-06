<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class AssignSubjectController extends Controller
{
    //
    public function AssignSubjectView()
    {
        $data['allData'] = AssignSubject::select('class_id')
            ->groupBy('class_id')
            ->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    public function AssignSubjectAdd()
    {
        $data['classes'] = StudentClass::all();
        $data['subjects'] = SchoolSubject::all();
        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }

    public function AssignSubjectStore(Request $request)
    {
        $countSubject = count($request->subject_id);

        if ($countSubject != NULL) {
            for ($i = 0; $i < $countSubject; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                // dd($assign_subject);
                $assign_subject->save();
            }
            $message = array(
                'alert-type' => 'success',
                'message' => 'Assign Subject Added Successfully',
            );
            return redirect()->route('assign.subject.view');
        }
    }

    public function AssignSubjectEdit($id)
    {
        $data['editData'] = AssignSubject::where('class_id', $id)
            ->orderBy('subject_id', 'asc')->get();
        $data['classes'] = StudentClass::all();
        $data['subjects'] = SchoolSubject::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }

    public function AssignSubjectUpdate(Request $request, $id)
    {
        AssignSubject::where('class_id', $id)->delete();
        $countSubject = count($request->subject_id);

        if ($countSubject != NULL) {
            for ($i = 0; $i < $countSubject; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                // dd($assign_subject);
                $assign_subject->save();
            }
            $message = array(
                'alert-type' => 'success',
                'message' => 'Assign Subject Updated Successfully',
            );
            return redirect()->route('assign.subject.view');
        }
    }

    public function AssignSubjectDetail($id)
    {
        $data['detail'] = AssignSubject::where('class_id', $id)
            ->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.detail_assign_subject', $data);
    }

    public function AssignSubjectDelete($id)
    {
        AssignSubject::where('class_id', $id)->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'Assign Subject Deleted Successfully',
        );
        return redirect()->route('assign.subject.view');
    }
}
