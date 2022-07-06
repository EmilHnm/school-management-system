@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Fee Amount Detail</h3>
                    <a href="{{ route('fee.amount.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Fee Amount</a>
                </div>
                <div class="box-body">
                    <h4><strong>Fee Category:</strong> {{ $detail['0']['fee_category']['name'] }}</h4>
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Class Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $index => $detailData)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $detailData['student_class']['name'] }}</td>
                                    <td>
                                        {{ $detailData->amount }}
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
