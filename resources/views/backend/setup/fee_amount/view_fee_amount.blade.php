@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Student Fee Amount List</h3>
                    <a href="{{ route('fee.amount.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Fee Amount</a>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Fee Categgory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $index => $amount)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $amount['fee_category']['name'] }}</td>
                                    <td>
                                        <a href="{{ route('fee.amount.edit', $amount->fee_category_id) }}" class="btn btn-info mb-5">Edit</a>
                                        <a href="{{ route('fee.amount.detail', $amount->fee_category_id) }}" class="btn btn-primary mb-5" >Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width:5%">SL</th>
                                <th>Name</th>
                                <th style="width:20%">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>

            </div>


            </div>

        </div>

        </section>


    </div>
</div>

@endsection
