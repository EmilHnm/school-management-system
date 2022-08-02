@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Employee Leave</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('employee.leave.update', $editData->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Employee Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="employee_id" required="" disabled  class="form-control">
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}" {{ $employee->id == $editData->employee_id ? 'selected'  : ''}}>{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('employee_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Leave Purpose<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="leave_purposes_id" id="leave_purposes_id" value="" required="" class="form-control">
                                                        <option value="" disabled="">Select Leave Purpose</option>
                                                        @foreach ($leave_purposes as $leave_purpose)
                                                            <option value="{{ $leave_purpose->id }}" {{ $leave_purpose->id == old('leave_purposes_id') ? 'selected'  : ($leave_purpose->id == $editData->leave_purposes_id ? 'selected' : '') }}>{{ $leave_purpose->name }}</option>
                                                        @endforeach
                                                            <option value="0" {{ old('leave_purposes_id') == '0' ? 'selected'  : ''}}>New Purpose</option>
                                                    </select>
                                                    <input type="text" name="add_another" id="add_another" value="{{old('add_another')}}" class="form-control" placeholder="Write Purpose" style="display: none">
                                                    @error('leave_purposes_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Start Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="start_date" class="form-control" value="{{old('start_date') ? old('start_date') : $editData->start_date}}">
                                                </div>
                                                @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>End Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="end_date" class="form-control" value="{{old('end_date') ? old('end_date') : $editData->start_date}}">
                                                </div>
                                                @error('end_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Submit">
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

<script>
    document.addEventListener('DOMContentLoaded', (e) => {
        let leave_purposes_id = document.getElementById('leave_purposes_id');
        let add_another = document.getElementById('add_another');
        if(leave_purposes_id.value == 0){
                add_another.style.display = 'block';
            }else{
                add_another.style.display = 'none';
            }
        leave_purposes_id.addEventListener('change', (e)=>{
            if(leave_purposes_id.value == 0){
                add_another.style.display = 'block';
            }else{
                add_another.style.display = 'none';
            }
        });
    });
</script>

@endsection
