<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Card - {{ $id_no}}</title>
    <style>
        :root {
                --main-color:#925de3;
            }
        *   {
            padding: 0;
            margin: 0;
        }
        body {
            display: flex;

            width: 100vw;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .card {
            height: 53.98mm;
            width:  85.6mm;
            border: 1px solid #000;
            border-radius: 3mm;
            overflow: hidden;
        }
        .card-header {
            width: 100%;
            height:20%;
            background-color: var(--main-color);

            font-family: Arial;
            display: flex;
            justify-content: center;
        }
        .card-title {
            color: white;
            height: 100%;
            width: 100%;
            font-weight: bold;
            text-align: right;
            line-height: 10mm;
            padding-right: 5mm;
        }
        .card .card-body {
            display: flex;
            width: 100%;
            padding: 3mm;
        }
        .card-body__picture {
            width: 20%;
            height: 50%;

        }
        .card-body__picture > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .card-body__infomation {
            width: 80%;
            height: 100%;

        }
        .card-body__infomation > .card-body__title {
            width: 100%;
            text-align: center;
            font-family: Arial;
            color: var(--main-color);
        }
        .card-body__text {
            font-size: 12px;
            display: flex;
            flex-wrap: wrap;
            width: 100%;
             margin-left: 2%;
        }
        .card-body__full {
            width: 100%;
            line-height: 26px;
            font-size: 13px;
            font-weight: bold;
            color: var(--main-color);

        }
        .card-body__text--left {
            width:56%;

        }
        .card-body__text--right {
            width:40%;
        }
        .body__text--title {
            line-height: 26px;
            font-size: 13px;
            font-weight: bold;
            color: var(--main-color);
        }
        .card-body__footer {
            width: 100%;
            height: 20%;
            text-align: center;
            font-size: 15px;
            background-color: var(--main-color);
            color: white;
            padding-top: 0.5mm;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Swallowtail School Manager</h4>
        </div>
        <hr>
        <div class="card-body">
            <div class="card-body__picture">
                <img src="{{  !empty($assign_student['student']['image'])  ? ('/upload/student_images/'.$assign_student['student']['image']) : asset('upload/user3-128x128.jpg')  }}" class="" alt="Image">
            </div>
            <div class="card-body__infomation">
                <h5 class="card-body__title">STUDENT CARD</h5>
                <div class="card-body__text">
                    <div class="card-body__full">Name: {{ strtoupper($assign_student->student->name )}}</div>
                    <div class="card-body__text--left">
                        <span class="body__text--title">Date of birth:</span> {{ date('Y/m/d',strtotime($assign_student->student->dob)) }}<br>
                        <span class="body__text--title">Session:</span> {{ $assign_student->student_year->name }}
                    </div>
                    <div class="card-body__text--right">
                        <span class="body__text--title">Gender:</span>{{ $assign_student->student->gender }}<br>
                        <span class="body__text--title">Group:</span> {{ $assign_student->student_group->name }}
                    </div>
                    <div class="card-body__full">Id Number: {{ $id_no}}</div>
                </div>

            </div>
        </div>
        <div class="card-body__footer">
            Create at : {{ date('Y/m') }}</div>
        </div>
    </div>
</body>
</html>
