@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Grade Marks</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('marks.entry.grade.update', $editData->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row"> <!-- First -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Grade Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="grade_name" class="form-control" value="{{ $editData->grade_name }}">
                                                </div>
                                                @error('grade_name')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Grade Point <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="grade_point" class="form-control" value="{{ $editData->grade_point }}">
                                                </div>
                                                @error('fname')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Start Marks <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="start_marks" class="form-control" value="{{ $editData->start_marks }}">
                                                </div>
                                                @error('start_marks')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Seconds -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>End Marks <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="end_marks" class="form-control" value="{{ $editData->end_marks }}">
                                                </div>
                                                @error('end_marks')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Start Point <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="start_point" class="form-control" value="{{ $editData->start_point }}">
                                                </div>
                                                @error('start_point')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>End Point <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="end_point" class="form-control" value="{{ $editData->end_point }}">
                                                </div>
                                                @error('end_point')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Third -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Remarks<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="remarks" class="form-control" value="{{ $editData->remarks }}">
                                                </div>
                                                @error('remarks')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
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
