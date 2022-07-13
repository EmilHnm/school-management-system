@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box bb-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Student <strong>Search</strong></h4>
                    </div>
                    <div class="box-body">
                        <form method="get" action="{{ route('student.year.class.wise') }}">
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Year </h5>
                                        <select name="year_id" id="year_id"  class="form-control">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ?  "selected" : '' }}>{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Class </h5>
                                        <select name="class_id" id="class_id"  class="form-control">
                                            <option value selected disabled>Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ (@$class_id == $class->id) ?  "selected" : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" name="Search" value="Submit" class="btn btn-rounded btn-dark mb-5" style="margin-top:25px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Student List</h3>
                    <a href="{{ route('student.registration.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Student</a>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        @if (!@$Search)
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Id No</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Image</th>
                                        @if (Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                        @endif
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $index => $student)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $student['student']['name'] }}</td>
                                            <td>{{ $student['student']['id_no'] }}</td>
                                            <td>{{ $student->roll }}</td>
                                            <td>{{ $student['student_year']['name'] }}</td>
                                            <td>{{ $student['student_class']['name'] }}</td>
                                            <td>
                                                <img id="showImg" src="{{  !empty($student['student']['image'])  ? ('/upload/student_images/'.$student['student']['image']) : asset('upload/user3-128x128.jpg')  }}" style="width:50px; height:50px;" alt="User Avatar">
                                            </td>
                                            @if (Auth::user()->role == 'Admin')
                                                <td>{{ $student['student']['code'] }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('student.registration.edit',$student->student_id) }}" class="btn btn-info mb-5">Edit</a>
                                                <a href="{{ route('student.year.delete',$student->id) }}" class="btn btn-danger mb-5" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:5%">SL</th>
                                        <th>Name</th>
                                        <th>Id No</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Image</th>
                                        @if (Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                        @endif
                                        <th style="width:20%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Id No</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Image</th>
                                        @if (Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                        @endif
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $index => $student)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $student['student']['name'] }}</td>
                                            <td>{{ $student['student']['id_no'] }}</td>
                                            <td>{{ $student->roll }}</td>
                                            <td>{{ $student['student_year']['name'] }}</td>
                                            <td>{{ $student['student_class']['name'] }}</td>
                                            <td>
                                                <img id="showImg" src="{{  !empty($student['student']['image'])  ? ('/upload/student_images/'.$student['student']['image']) : asset('upload/user3-128x128.jpg')  }}" style="width:50px; height:50px;" alt="User Avatar">
                                            </td>
                                            @if (Auth::user()->role == 'Admin')
                                                <td>{{ $student['student']['code'] }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('student.year.edit',$student->id) }}" class="btn btn-info mb-5">Edit</a>
                                                <a href="{{ route('student.year.delete',$student->id) }}" class="btn btn-danger mb-5" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:5%">SL</th>
                                        <th>Name</th>
                                        <th>Id No</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Image</th>
                                        @if (Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                        @endif
                                        <th style="width:20%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection

