@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Promotion Student</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('promotion.student.registration', $editData->student_id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row"> <!-- First -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" value="{{ $editData['student']['name'] }}">
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
                                                    <input type="text" name="fname" class="form-control" value="{{ $editData['student']['fname'] }}">
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
                                                    <input type="text" name="mname" class="form-control" value="{{ $editData['student']['mname'] }}">
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
                                                    <input type="text" name="mobile" class="form-control" value="{{ $editData['student']['mobile'] }}">
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
                                                    <input type="text" name="address" class="form-control" value="{{ $editData['student']['address'] }}">
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
                                                        <option value="Male"  {{ $editData['student']['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female" {{ $editData['student']['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
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
                                                        <option value="Vietnam"   {{ $editData['student']['religion'] == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                                        <option value="oversea" {{ $editData['student']['religion'] == 'oversea' ? 'selected' : '' }}>Oversea</option>
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
                                                    <input type="date" name="dob" class="form-control" value="{{ $editData['student']['dob'] }}">
                                                </div>
                                            </div>
                                            @error('dob')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Discount <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount" class="form-control" value="{{ $editData['discount']['discount'] }}">
                                                </div>
                                                @error('discount')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Forth -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger">*</span></h5>
                                                    <select name="year_id" id="year_id"  class="form-control">
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}" {{ $editData['year_id'] == $year->id ? 'selected' : ''}}>{{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @error('year_id')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class <span class="text-danger">*</span></h5>
                                                    <select name="class_id" id="class_id"  class="form-control">
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}" {{ $editData['class_id'] == $class->id ? 'selected' : ''}}>{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @error('class_id')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Group <span class="text-danger">*</span></h5>
                                                    <select name="group_id" id="group_id"  class="form-control">
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}" {{ $editData['group_id'] == $group->id ? 'selected' : ''}}>{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @error('group_id')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> <!-- Fifth -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Shift <span class="text-danger">*</span></h5>
                                                    <select name="shift_id" id="shift_id"  class="form-control">
                                                        <option value selected disabled>Select Year</option>
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}" {{ $editData['shift_id'] == $shift->id ? 'selected' : ''}}>{{ $shift->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @error('shift_id')
                                                    <span class="text-danger">This field is required</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img id="showImg" class="rounded-circle" src="{{  !empty($editData['student']['image'])  ? ('/upload/student_images/'.$editData['student']['image']) : asset('upload/user3-128x128.jpg')  }}" style="width:100px; height:100px; border: 1px solid #000" alt="User Avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Promotion">
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
