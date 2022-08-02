@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Employee Attendance - {{ $details[0]['date'] }}</h3>
                    @if (Auth::user()->role == 'Admin')
                        <a href="{{ route('employee.attendance.delete', $details[0]['date']) }}" style="float: right" class="btn btn-rounded btn-danger mb-5" id="delete">Delete</a>
                    @endif
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>

                                <th>Name</th>
                                <th>ID No</th>
                                <th>Attend Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $index => $attendance)
                                <tr>
                                    <td>{{ $index+1 }}</td>

                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->user->id_no }}</td>
                                    <td>{{ $attendance->attend_status }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width:5%">SL</th>
                                <th>Name</th>
                                <th>ID No</th>
                                <th>Attend Status</th>
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
