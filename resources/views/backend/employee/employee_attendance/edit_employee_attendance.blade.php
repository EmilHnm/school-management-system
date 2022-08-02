@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Employee Attendance </h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('employee.attendance.update', $editData['0']['date']) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Attendance Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date" class="form-control" value="{{ $editData['0']['date'] }}">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Sl</th>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Employee List</th>
                                                        <th colspan="3" class="text-center" style="vertical-align: middle; width:30%">Attendance Status</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center btn present_all" style="display:table-cell; background-color: #000">Present</th>
                                                        <th class="text-center btn leave_all" style="display:table-cell; background-color: #000">Leave</th>
                                                        <th class="text-center btn absent_all" style="display:table-cell; background-color: #000">Absent</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($editData as $index => $data)
                                                        <tr id="div{{ $data->id }}" class="text-center">
                                                            <input type="hidden" name="employee_id[]" value="{{ $data->employee_id }}" />
                                                            <td >{{ $index+1 }}</td>
                                                            <td>{{ $data->user->name }}</td>
                                                            <td colspan="3">
                                                                <div class="switch-toggle switch-3 switch-candy">
                                                                    <input name="attend_status_{{ $index }}" type="radio" value="Present" class="with-gap" id="present_{{ $index }}" {{ $data->attend_status == 'Present' ? 'checked' : '' }}>
                                                                    <label for="present_{{ $index }}">Present</label>
                                                                    <input name="attend_status_{{ $index }}" type="radio" value="Leave" class="with-gap" id="leave_{{ $index }}" {{ $data->attend_status == 'Leave' ? 'checked' : '' }}>
                                                                    <label for="leave_{{ $index }}">Leave</label>
                                                                    <input name="attend_status_{{ $index }}" type="radio" value="Absent" class="with-gap" id="absent_{{ $index }}" {{ $data->attend_status == 'Absent' ? 'checked' : '' }}>
                                                                    <label for="absent_{{ $index }}">Absent</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>


@endsection
