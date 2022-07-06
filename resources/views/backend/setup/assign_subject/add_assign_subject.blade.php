@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Assign Subject</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('assign.subject.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="add_item">
                                        <div class="form-group">
                                            <h5>Class Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" value="" id="select" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('usertype')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <h5>Student Subject <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subject_id[]" value="" id="select" required="" class="form-control">
                                                            <option value="id" selected="" disabled="">Select Subject</option>
                                                            @foreach ($subjects as $subject)
                                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('usertype')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Full Mark <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="full_mark[]" class="form-control">
                                                    </div>
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Pass Mark <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="pass_mark[]" class="form-control">
                                                    </div>
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="subjective_mark[]" class="form-control">
                                                    </div>
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding-top:25px">
                                                <span class="btn btn-success addeventmore">
                                                    <i class="fa fa-plus-circle"></i>
                                                </span>
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

<div class="" style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Student Subject <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subject_id[]" value="" id="select" required="" class="form-control">
                                <option value="id" selected="" disabled="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('usertype')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Full Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="full_mark[]" class="form-control">
                        </div>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Pass Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="pass_mark[]" class="form-control">
                        </div>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Subjective Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="subjective_mark[]" class="form-control">
                        </div>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-1" style="padding-top:25px">
                    <span class="btn btn-success addeventmore">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span class="btn btn-danger removeeventmore">
                        <i class="fa fa-minus-circle"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var add_item = document.querySelector('.add_item');
    window.addEventListener('DOMContentLoaded', (event) => {
        var counter = 0;

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('addeventmore') || e.target.classList.contains('fa-plus-circle')) {
                counter++;
                var whole_extra_item_add = document.querySelector('#whole_extra_item_add').cloneNode(true);
                add_item.appendChild(whole_extra_item_add) ;
            }
            if (e.target.classList.contains('removeeventmore') || e.target.classList.contains('fa-minus-circle')) {
                counter--;
                e.target.closest('#whole_extra_item_add').remove();
            }
        })
    });

</script>

@endsection
