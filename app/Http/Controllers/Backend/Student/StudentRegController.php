<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DiscountStudent;

class StudentRegController extends Controller
{
    //
    public function StudentRegView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = StudentYear::orderBy('id', 'asc')->first()?->id;
        $data['class_id'] = StudentClass::orderBy('id', 'asc')->first()?->id;
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student_reg.view_student', $data);
    }

    public function StudentClassYearWise(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.student_reg.view_student', $data);
    }


    public function StudentRegAdd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.add_student', $data);
    }

    public function StudentRegStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'fname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required',
            'group_id' => 'required',
            'shift_id' => 'required',
            'image' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::where('id', $request->year_id)->first()->name;
            $student = User::where('usertype', 'Student')->orderBy('id', 'desc')->first();

            if ($student == null) {
                $firstReg = 0;
                $student_id = $firstReg + 1;
                if ($student_id < 10) {
                    $id_no = '000' . $student_id;
                } elseif ($student_id < 100) {
                    $id_no = '00' . $student_id;
                } elseif ($student_id < 1000) {
                    $id_no = '0' . $student_id;
                } else {
                    $id_no = $student_id;
                }
            } else {
                $student = User::where('usertype', 'Student')->orderBy('id', 'desc')->first()->id;
                $student_id = $student + 1;
                if ($student_id < 10) {
                    $id_no = '000' . $student_id;
                } elseif ($student_id < 100) {
                    $id_no = '00' . $student_id;
                } elseif ($student_id < 1000) {
                    $id_no = '0' . $student_id;
                } else {
                    $id_no = $student_id;
                }
            }
            $final_id_no = $checkYear . $id_no;

            //Add to User table
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->mname = $request->mname;
            $user->fname = $request->fname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user->image = $filename;
            }
            $user->save();

            // Add to assign_students table
            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            // Add to discount_students table
            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $message = array(
            'message' => 'Student Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.registration.view')->with($message);
    }

    public function StudentRegEdit($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with(['student', 'discount'])
            ->where('student_id', $student_id)
            ->first();
        // dd($data['editData']->toArray());

        return view('backend.student.student_reg.edit_student', $data);
    }

    public function StudentRegUpdate($student_id, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'fname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required',
            'group_id' => 'required',
            'shift_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $student_id) {

            //Update to User table
            $user = User::find($student_id);
            $user->name = $request->name;
            $user->mname = $request->mname;
            $user->fname = $request->fname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images' . $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user->image = $filename;
            }
            $user->save();

            // Update to assign_students table
            $assign_student = AssignStudent::where('student_id', $student_id)
                ->where('id', $request->id)
                ->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            // Update to discount_students table
            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $message = array(
            'message' => 'Student Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.registration.view')->with($message);
    }

    public function StudentRegPromotion($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with(['student', 'discount'])
            ->where('student_id', $student_id)
            ->first();

        return view('backend.student.student_reg.promotion_student', $data);
    }

    /**
     * StudentUpdatePromotion
     *
     * @param  mixed $student_id
     * @param  mixed $request
     * @return void
     */
    public function StudentUpdatePromotion($student_id, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'fname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required',
            'group_id' => 'required',
            'shift_id' => 'required',
        ]);

        // dd($request->discount);
        DB::transaction(function () use ($request, $student_id) {

            //Update to User table
            $user = User::find($student_id);
            $user->name = $request->name;
            $user->mname = $request->mname;
            $user->fname = $request->fname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images' . $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user->image = $filename;
            }
            $user->save();

            // Update to assign_students table
            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            // Update to discount_students table
            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $message = array(
            'message' => 'Student Promotion Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.registration.view')->with($message);
    }

    public function StudentRegDetails($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with([
            'student',
            'discount',
            'student_class',
            'student_year', 'student_group', 'student_shift'
        ])
            ->where('student_id', $student_id)
            ->first();
        $data['assigns_student'] =
            AssignStudent::with([
                'student_class',
                'student_year', 'student_group', 'student_shift'
            ])
            ->where('student_id', $student_id)
            ->get();
        //$pdf = PDF::loadView('backend.student.student_reg.detail_student', $data)
        //    ->setOptions(['defaultFont' => 'sans-serif']);
        return view('backend.student.student_reg.detail_student', $data);
        //return $pdf->download("student_details_" . $student_id . ".pdf");
    }

    /**
     * IdCardView
     *
     * @return void
     */
    public function IdCardView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.student_reg.idcard_student', $data);
    }

    /**
     * IdCardGet
     *
     * @param  mixed $request
     * @return void
     */
    public function IdCardGet(Request $request)
    {
        $id_no = $request->id_no;
        $check_data = User::where('id_no', $id_no)->first()->id;
        if ($check_data) {
            $data['assign_student'] = AssignStudent::with(['student', 'student_class', 'student_year', 'student_group'])
                ->where('student_id', $check_data)
                ->first();
            $data['id_no'] = $id_no;
            // $pdf = PDF::loadView('backend.student.student_reg.print_idcard_student', $data)
            //     ->setOptions(['defaultFont' => 'sans-serif'])
            //     ->setPaper('a4', 'portrait');
            return view('backend.student.student_reg.print_idcard_student', $data);
            //return $pdf->download("report_" . $id_no . '_' . date('Y-m-d') . ".pdf");
        } else {
            $message = array(
                'alert-type' => 'error',
                'message' => 'No data found'
            );
            return redirect()->back()->with($message);
        }
    }
}
