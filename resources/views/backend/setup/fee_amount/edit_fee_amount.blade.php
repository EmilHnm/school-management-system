@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Fee Amount</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('fee.amount.update',$editData['0']->fee_category_id ) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="add_item">
                                        <div class="form-group">
                                            <h5>Fee Category <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="fee_category_id" value="" id="select" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Fee Category</option>
                                                    @foreach ($fee_categories as $category)
                                                        <option value="{{ $category->id }}" {{ ($editData['0']->fee_category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('usertype')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @foreach ($editData as $i=>$edit)
                                            <div class="whole_extra_item_add" >
                                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <h5>Fee Category <span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <select name="class_id[]" value="" id="select" required="" class="form-control">
                                                                        <option value="id" selected="" disabled="">Select Student Class</option>
                                                                        @foreach ($classes as $class)
                                                                            <option value="{{ $class->id }}" {{ ($edit->class_id == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('usertype')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <h5>Amount <span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <input type="text" name="amount[]" class="form-control" value="{{ $edit->amount }}">
                                                                </div>
                                                                @error('amount[]')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2" style="padding-top:25px">
                                                            <span class="btn btn-success addeventmore">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </span>
                                                            @if ($i != 0)
                                                                <span class="btn btn-danger removeeventmore">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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

<div class="" style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Fee Category <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="class_id[]" value="" id="select" required="" class="form-control">
                                <option value="id" selected="" disabled="">Select Student Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('usertype')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Amount <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="amount[]" class="form-control">
                        </div>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2" style="padding-top:25px">
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
                e.target.closest('.whole_extra_item_add').remove();
            }
        })
    });

</script>

@endsection
