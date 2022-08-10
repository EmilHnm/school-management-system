@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Other Salary List</h3>
                    <a href="{{ route('other.cost.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Other Cost</a>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Receipt Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $index => $value)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->amount }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                        <img id="showImg" src="{{  !empty($value['receipt_image'])  ? ('/upload/other_cost_images/'.$value['receipt_image']) : asset('upload/no_image.jpg')  }}" style="width:50px; height:50px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('other.cost.edit', $value->id) }}" class="btn btn-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width:5%">SL</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th style="width:40%">Description</th>
                                <th>Receipt Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection
