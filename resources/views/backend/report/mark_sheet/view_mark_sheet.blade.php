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
                            <form method="get" action="{{ route('marksheet.generator.get') }}" target="_blank">
                                @csrf
                                <div class="row" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Year <span class="text-danger">*</span></h5>
                                            <select name="year_id" id="year_id"  class="form-control">
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ?  "selected" : '' }}>{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('year_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Class <span class="text-danger">*</span></h5>
                                            <select name="class_id" id="class_id"  class="form-control">
                                                <option value="" disabled selected>Please select a class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" {{ (@$class_id == $class->id) ?  "selected" : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Exam Type <span class="text-danger">*</span></h5>
                                            <select name="exam_type_id" id="exam_type_id"  class="form-control">
                                                <option value="" disabled selected >Please select a exam type</option>
                                                @foreach ($exam_types as $exam_type)
                                                    <option value="{{ $exam_type->id }}" >{{ $exam_type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('exam_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>ID No <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="id_no" class="form-control" >
                                            </div>
                                            @error('id_no')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="btn btn-rounded btn-info"  value="Submit">
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

