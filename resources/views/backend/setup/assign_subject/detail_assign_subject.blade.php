@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Assign Subject Detail</h3>
                    <a href="{{ route('assign.subject.delete', $detail['0']->class_id) }}" style="float: right" class="btn btn-rounded btn-danger mb-5" id="delete">Delete Assign Subject</a>
                </div>
                <div class="box-body">
                    <h4><strong>Assign Subject Name:</strong> {{ $detail['0']['student_class']['name'] }}</h4>
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Subject Name</th>
                                <th>Full Mark</th>
                                <th>Pass Mark</th>
                                <th>Subjective Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $index => $detailData)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $detailData['school_subject']['name'] }}</td>
                                    <td>
                                        {{ $detailData->full_mark }}
                                    </td>
                                    <td>
                                        {{ $detailData->pass_mark }}
                                    </td>
                                    <td>
                                        {{ $detailData->subjective_mark }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Subject Name</th>
                                <th>Full Mark</th>
                                <th>Pass Mark</th>
                                <th>Subjective Mark</th>
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
