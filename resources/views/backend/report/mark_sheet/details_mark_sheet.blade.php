@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-info">
                            <div class="box-header">
                                <h4 class="box-title">Manage <strong>Marks Sheet</strong></h4>
                                <a href="{{ route('marksheet.generator.print') . '?year_id=' . $data['year_id'] .'&class_id='. $data['class_id'].'&exam_type_id='. $data['exam_type_id'].'&id_no='. $data['id_no'] }}" class="btn btn-success btn-rounded " style="float:right" target="_blank">Generate PDF</a>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-2 text-center" style="float:right">
                                        <img src="{{ url('/upload/no_image.jpg') }}" style="width:120px; height:120px"
                                            alt="" srcset="">
                                    </div>
                                    <div class="col-md-2 text-center"></div>
                                    <div class="col-md-6 text-center" style="float:left">
                                        <h4><strong>Swalowtail School Management</strong></h4>
                                        <h6><strong>www.school-management.com</strong></h6>
                                        <h5><strong>EmilRailgun</strong></h5>
                                        <h6><strong>{{ $allMarks[0]['exam_type']['name'] }}</strong></h6>
                                    </div>
                                    <div class="col-md-12">
                                        <hr style="border:0.5px solid #8d8d8d; width:100%; margin-bottom:0px">
                                        <p style="text-align:right"><u><i>Print Date:</i></u> {{ date('Y-m-d') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table border="1" cellpadding='8' cellspacing='2'
                                            style="border-color:#838383; width:100%; ">
                                            @php
                                                $assign_sudent = \App\Models\AssignStudent::where('year_id', $allMarks[0]['year_id'])
                                                    ->where('class_id', $allMarks[0]['class_id'])
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td width="50%">Student Id</td>
                                                <td width="50%">{{ $allMarks[0]['id_no'] }}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Roll Number</td>
                                                <td width="50%">{{ $assign_sudent->roll ? $assign_sudent->roll : 'Empty' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Name</td>
                                                <td width="50%">{{ $allMarks[0]->student->name }}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Class</td>
                                                <td width="50%">{{ $allMarks[0]->student_class->name }}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Session</td>
                                                <td width="50%">{{ $allMarks[0]->student_year->name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table border="1" cellpadding='8' cellspacing='2'
                                            style="border-color:#838383; width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th>Letter Grade</th>
                                                    <th>Marks</th>
                                                    <th>Grade Point</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allGrade as $grade)
                                                    <tr>
                                                        <td>{{ $grade->grade_name }}</td>
                                                        <td>{{ $grade->start_marks }} - {{ $grade->end_marks }}</td>
                                                        <td>{{ number_format((float) $grade->grade_point, 2) }}
                                                            -
                                                            {{ $grade->grade_point == 4
                                                                ? number_format((float) $grade->grade_point, 2)
                                                                : number_format((float) $grade->grade_point + 0.99, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1" style="border-color: #838383;" width="100%" cellpadding="8"
                                            cellspacing="2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">SL</th>
                                                    <th class="text-center">Get Marks</th>
                                                    <th class="text-center">Letter Grade</th>
                                                    <th class="text-center">Grade Point</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total_marks = 0;
                                                    $total_point = 0;
                                                @endphp
                                                @foreach ($allMarks as $key => $mark)
                                                    @php
                                                        $get_mark = $mark->marks;
                                                        $total_marks = (float) $total_marks + (float) $get_mark;
                                                        $total_subject = App\Models\StudentMarks::where('year_id', $mark->year_id)
                                                            ->where('class_id', $mark->class_id)
                                                            ->where('exam_type_id', $mark->exam_type_id)
                                                            ->where('student_id', $mark->student_id)
                                                            ->get()
                                                            ->count();
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td class="text-center">{{ $get_mark }}</td>
                                                        @php
                                                            $grade_marks = App\Models\MarksGrade::where([['start_marks', '<=', (int) $get_mark], ['end_marks', '>=', (int) $get_mark]])->first();
                                                            $grade_name = $grade_marks->grade_name;
                                                            $grade_point = number_format((float) $grade_marks->grade_point, 2);
                                                            $total_point = (float) $total_point + (float) $grade_point;
                                                        @endphp
                                                        <td class="text-center">{{ $grade_name }}</td>
                                                        <td class="text-center">{{ $grade_point }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3"><strong style="padding-left: 30px;">Total
                                                            Marks</strong></td>
                                                    <td colspan="3" class="text-center">
                                                        <strong>{{ $total_marks }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1" style="border-color: #838383;" width="100%" cellpadding="8"
                                            cellspacing="2">
                                            @php
                                                $total_grade = 0;
                                                $point_for_letter_grade = (float) $total_point / (float) $total_subject;
                                                $total_grade = App\Models\MarksGrade::where('start_point', '<=', $point_for_letter_grade)
                                                    ->where('end_point', '>=', $point_for_letter_grade)
                                                    ->first();
                                                $grade_point_avg = (float) $total_point / (float) $total_subject;
                                            @endphp
                                            <tr>
                                                <td width="50%"><strong>Grade Point Average</strong></td>
                                                <td width="50%" class="text-center">
                                                    @if ($countFail > 0)
                                                        0.00
                                                    @else
                                                        {{ number_format((float) $grade_point_avg, 2) }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%"><strong>Letter Grade </strong></td>
                                                <td width="50%" class="text-center">
                                                    @if ($countFail > 0)
                                                        F
                                                    @else
                                                        {{ $total_grade->grade_name }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Total Marks with Fraction</td>
                                                <td width="50%" class="text-center">
                                                    <strong>{{ $total_marks }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1" style="border-color: #ffffff;" width="100%" cellpadding="8"
                                            cellspacing="2">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: left;"><strong>Remarks:</strong>
                                                        @if ($countFail > 0)
                                                            Fail
                                                        @else
                                                            {{ $total_grade->remarks }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    </div>
@endsection
