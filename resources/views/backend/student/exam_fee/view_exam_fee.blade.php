@extends('admin.admin_master')
@section('admin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box bb-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Student <strong>Exam Fee</strong></h4>
                    </div>
                    <div class="box-body">
                            @csrf
                            <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Year </h5>
                                        <select name="year_id" id="year_id"  class="form-control">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Class </h5>
                                        <select name="class_id" id="class_id"  class="form-control">
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Exam Type </h5>
                                        <select name="exam_type_id" id="exam_type_id" class="form-control">
                                            @foreach ($exam_types as $exam_type)
                                                <option value="{{ $exam_type->id }}" >{{ $exam_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a id="search" name="search" class="btn btn-primary" style="margin-top:25px">Search</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="documentResult">

                                    </div>
                                    <script id="document-template" type="text/x-handlebars-template">
                                            <table class="table table-border table-striped" id="example1" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        @{{{thsource}}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @{{#each this}}
                                                        <tr>
                                                            @{{{tdsource}}}
                                                        </tr>
                                                    @{{/each}}
                                                </tbody>
                                            </table>
                                        </script>
                                </div>
                            </div>

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

<script type="text/javascript">
    document.getElementById('search').addEventListener('click', (e) => {
        let year_id = document.getElementById('year_id').value;
        let class_id = document.getElementById('class_id').value;
        let exam_type_id = document.getElementById('exam_type_id').value;
        let url = new URL("{{ route('student.exam.fee.classwise.get') }}");
        let param = {
            year_id: year_id,
            class_id: class_id,
            exam_type_id: exam_type_id,
        };
        url.search = new URLSearchParams(param).toString();
        //console.log(url);
        fetch(url, { "method": "GET",})
            .then(
                (response) => {
                    if (response.status != 200) {
                        console.error('Status Code: ' + response.status);
                        return;
                    }
                    response.json().then(function(data) {
                        //console.log(data);
                        var source = document.getElementById("document-template").innerHTML;
                        var template = Handlebars.compile(source);
                        var html = template(data);
                        document.getElementById("documentResult").innerHTML = html;

                    });
                }
            );
    })
</script>

@endsection

