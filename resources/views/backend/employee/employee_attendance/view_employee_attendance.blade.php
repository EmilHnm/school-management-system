@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Employee Attendance List</h3>
                    <a href="{{ route('employee.attendance.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Employee Attendance</a>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>

                                <th>Date</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $index => $attendance)
                                <tr>
                                    <td>{{ $index+1 }}</td>

                                    <td>{{ $attendance->date }}</td>
                                    <td>
                                        <a href="{{ route('employee.attendance.edit',$attendance->date) }}" class="btn btn-info mb-5">Edit</a>
                                        <a href="{{ route('employee.attendance.details',$attendance->date) }}" class="btn btn-danger mb-5">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width:5%">SL</th>


                                <th>Date</th>


                                <th style="width:20%">Action</th>
                            </tr>
                        </tfoot>
                    </table>
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