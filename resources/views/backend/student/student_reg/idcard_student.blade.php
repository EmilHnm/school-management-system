@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Manage <strong>Student ID Card</strong></h4>
                        </div>
                        <div class="box-body">
                            <form method="get" action="{{ route('report.student.idcard.get') }}" target="_blank">
                                @csrf
                                <div class="row" >
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Student ID No <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="id_no" class="form-control" >
                                            </div>
                                            @error('id_no')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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

