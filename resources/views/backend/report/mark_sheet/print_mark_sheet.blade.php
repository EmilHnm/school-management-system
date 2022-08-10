<html>
	<head>
        <title>Mark Report</title>
        <link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>
            <style>
                /*Define color of the theme*/
                :root {
                    --main-color:#925de3;
                }

                body {
                background: white;
                }

                page[size="A4"] {
                background: white;
                width: 21cm;
                height: 29.7cm;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.0cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
                }
                @media print {
                body, page[size="A4"] {
                    margin: 0;
                    box-shadow: 0;
                    }
                }
                .topBar {
                    padding: 25px 35px 10px;
                    border-bottom: 4px solid var(--main-color);
                    display: flex;
                    justify-content: space-between;
                }
                .icons{
                    width:16px;
                    height:16px;
                }

                #name h1 {
                    font-size: 2.5em;
                    font-weight: 500;
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                    margin-bottom: -6px;
                }

                #name h2 {
                    font-size: 1.2em;
                    margin-left: 2px;
                    font-weight: 100;
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                }

                #name {
                    float: left;
                    width: 50%;
                    text-align: center;
                }
                .contactDetails {
                    float: right;

                }

                #contactDetails ul {
                    list-style-type: none;
                    font-size: 0.8em;
                    margin-top: 2px;
                    text-align: right;
                }
                #contactDetails ul li {
                    margin-bottom: 3px;
                    color: #444;
                }
                #contactDetails ul li a, a[href^=tel] {
                    color: #444;
                    text-decoration: none;
                }


                #mainDocument {
                    padding: 0 40px;
                }

                section {
                    border-top: 1px solid #dedede;
                }

                section:first-child {
                    border-top: 0;
                }

                .sectionTitle{
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                    font-size: 1.5em;
                    margin-bottom: -10px;
                    text-transform: uppercase;
                    color: var(--main-color);
                }

                .table {
                    width:100%;
                    margin-top: 20px;
                    border: 2px solid var(--main-color);

                    border-spacing: 0;
                    border-collapse: collapse;
                }
                .table  td,th {
                    border: 1px solid var(--main-color);
                    padding: 8px;
                }
                .table-title {
                    font-size: 1.1em;
                    font-weight: bold;
                    color: var(--main-color);
                    padding: 5px 0;
                }
                .table-title-study {
                    font-size: 1.1em;
                    font-weight: bold;
                    background: var(--main-color);
                    padding: 5px 0;
                    width: 20%;
                    color: white;
                    text-align: center;
                }
                .row {
                    display: flex;
                    width: 100%;
                }
                .col-md-6 {
                    width: 50%;
                    padding: 10px
                }
                .col-md-12 {
                    width: 100%;
                    padding: 10px
                }
                .text-center {
                    text-align: center;
                }
            </style>
    </head>
    <body>
    <page size="A4"> <!-- Begin first page -->
        <!-- ==================================     TOP BAR    ================================== -->
        <div class="topBar">

            <div id="name">
                <h1 class="">Marks Sheet</h1>
                <h2 class="">{{ $allMarks[0]['exam_type']['name'] }}</h2>
            </div>

            <div id="contactDetails" >
                <ul>
                    <li>Swallowtail School Management</li>
                    <li><a href="#" target="_blank" >www.school-management.com</a></li>
                    <li><a href="https://github.com/EmilRailgun" target="_blank">EmilRailgun</a></li>
                    <li><strong>Create at:</strong> {{ date('d/m/Y') }}</li>
                </ul>
            </div>
        </div>

        <div id="mainDocument">
            <section>
                <div class="section">
                    <h1 class="sectionTitle">INFORMATION</h1>
                    <article>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    @php
                                        $assign_sudent = \App\Models\AssignStudent::where('year_id', $allMarks[0]['year_id'])
                                            ->where('class_id', $allMarks[0]['class_id'])
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td class="table-title" width="50%">Student Id</td>
                                        <td width="50%">{{ $allMarks[0]['id_no'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-title" width="50%">Roll Number</td>
                                        <td width="50%">{{ $assign_sudent->roll ? $assign_sudent->roll : 'Empty' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-title" width="50%">Name</td>
                                        <td width="50%">{{ $allMarks[0]->student->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-title" width="50%">Class</td>
                                        <td width="50%">{{ $allMarks[0]->student_class->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-title" width="50%">Session</td>
                                        <td width="50%">{{ $allMarks[0]->student_year->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="table-title">Letter Grade</th>
                                            <th class="table-title">Marks</th>
                                            <th class="table-title">Grade Point</th>
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
                    </article>
                    <h1 class="sectionTitle">Marks</h1>
                    <article>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center table-title">SL</th>
                                            <th class="text-center table-title">Get Marks</th>
                                            <th class="text-center table-title">Letter Grade</th>
                                            <th class="text-center table-title">Grade Point</th>
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
                    </article>
                    <h1 class="sectionTitle">GRADE</h1>
                    <article>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    @php
                                        $total_grade = 0;
                                        $point_for_letter_grade = (float) $total_point / (float) $total_subject;
                                        $total_grade = App\Models\MarksGrade::where('start_point', '<=', $point_for_letter_grade)
                                            ->where('end_point', '>=', $point_for_letter_grade)
                                            ->first();
                                        $grade_point_avg = (float) $total_point / (float) $total_subject;
                                    @endphp
                                    <tr>
                                        <td width="50%" class="table-title"><strong>Grade Point Average</strong></td>
                                        <td width="50%" class="text-center">
                                            @if ($countFail > 0)
                                                0.00
                                            @else
                                                {{ number_format((float) $grade_point_avg, 2) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="table-title"><strong>Letter Grade </strong></td>
                                        <td width="50%" class="text-center">
                                            @if ($countFail > 0)
                                                F
                                            @else
                                                {{ $total_grade->grade_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="table-title">Total Marks with Fraction</td>
                                        <td width="50%" class="text-center">
                                            <strong>{{ $total_marks }}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </article>
                    <h1 class="sectionTitle">REMARKS</h1>
                    <article>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
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
                    </article>
                </div>
            </section>
        </div>
    </page>

    </body>
</html>
