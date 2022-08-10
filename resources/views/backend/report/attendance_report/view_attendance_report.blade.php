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
                        </div>
                        <div class="box-body">
                            <form method="get" action="{{ route('report.attendance.get') }}" target="_blank">
                                @csrf
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year <span class="text-danger">*</span></h5>
                                            <select name="employee_id" id="employee_id"  class="form-control">
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}" >{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" class="form-control" >
                                            </div>
                                            @error('date')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-rounded btn-info" style="margin-top:25px"  value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.col -->
            </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>


@endsection

