@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Employee</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('employee.registration.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row"> <!-- First -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" >
                                                </div>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Father's Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="fname" class="form-control" >
                                                </div>
                                            </div>
                                            @error('fname')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mother's Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mname" class="form-control" >
                                                </div>
                                            </div>
                                            @error('mname')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Seconds -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mobile Number <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mobile" class="form-control" >
                                                </div>
                                            </div>
                                            @error('mobile')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Address <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="address" class="form-control" >
                                                </div>
                                            </div>
                                            @error('address')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Gender <span class="text-danger">*</span></h5>
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value selected disabled>Select Gender</option>
                                                        <option value="Male"  >Male</option>
                                                        <option value="Female" >Female</option>
                                                    </select>
                                                @error('gender')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Third -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Religion <span class="text-danger">*</span></h5>
                                                    <select name="religion" id="religion"  class="form-control">
                                                        <option value selected disabled>Select Religion</option>
                                                        <option value="Vietnam"  >Vietnam</option>
                                                        <option value="oversea" >Oversea</option>
                                                    </select>
                                                @error('religion')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Date of Birth<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="dob" class="form-control" >
                                                </div>
                                            </div>
                                            @error('dob')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Designation <span class="text-danger">*</span></h5>
                                                <select name="designation_id" id="designation_id"  class="form-control">
                                                    <option value selected disabled>Select Designation</option>
                                                    @foreach ($designations as $designation)
                                                        <option value="{{ $designation->id }}" >{{ $designation->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('designation_id')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Forth -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Salary <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="salary" class="form-control" >
                                                </div>
                                            </div>
                                            @error('salary')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Joining Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="join_date" class="form-control" >
                                                </div>
                                            </div>
                                            @error('join_date')
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Profile Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input name="image" type="file" class="form-control" id="Img" >
                                                </div>
                                                @error('image')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img id="showImg" class="rounded-circle" src="{{ url('upload/user3-128x128.jpg')  }}" style="width:100px; height:100px; border: 1px solid #000" alt="User Avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Fifth -->


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

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', ()=>{
        const Img = document.getElementById('Img');
        const showImg = document.getElementById('showImg');
        Img.addEventListener('change', (e)=>{
            const reader = new FileReader();
            reader.onload = (e)=>{
                showImg.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
