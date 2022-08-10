@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Other Cost</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('other.cost.update', $editData->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date" class="form-control" value="{{ $editData->date }}">
                                                </div>
                                                @error('date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Amount <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="amount" class="form-control" value="{{ $editData->amount }}">
                                                </div>
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="description" id="description" class="form-control" required="" placeholder="Enter the description" aria-invalid="false" >{{ $editData->description }}</textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Receipt Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input name="receipt_image" type="file" class="form-control" id="Img" >
                                                    @error('receipt_image')
                                                        <span class="text-danger">This field is required</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img id="showImg" class="" src="{{  !empty($editData['receipt_image'])  ? ('/upload/other_cost_images/'.$editData['receipt_image']) : asset('upload/no_image.jpg')  }}" style="width:200px; height:200px; border: 1px solid #000" >
                                                </div>
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
