@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box bb-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Student <strong>Roll Generator</strong></h4>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('roll.generate.store') }}">
                            @csrf
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Year </h5>
                                        <select name="year_id" id="year_id"  class="form-control">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ?  "selected" : '' }}>{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Class </h5>
                                        <select name="class_id" id="class_id"  class="form-control">
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ (@$class_id == $class->id) ?  "selected" : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a id="search" name="search" class="btn btn-primary">Search</a>
                                </div>
                            </div>
                            <div class="row d-none" id="roll-generate">
                                <div class="col-md-12">
                                    <table class="table table-border table-striped" id="example1" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Student Name</th>
                                                <th>Father Name</th>
                                                <th>Gender</th>
                                                <th>Roll</th>
                                            </tr>
                                        </thead>
                                        <tbody id="roll-generate-tr">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info" value="Roll Generate">
                        </form>
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
        let url = new URL("{{ route('student.registration.getstudents') }}");
        let param = {
            year_id: year_id,
            class_id: class_id
        };
        url.search = new URLSearchParams(param).toString();
        //console.log(url);
        fetch(url, { "method": "GET",})
            .then(
                function(response) {
                    if (response.status != 200) {
                        console.error('Status Code: ' + response.status);
                        return;
                    }
                    response.json().then(function(data) {
                        //console.log(data);
                        let html = '';
                        document.getElementById('roll-generate').classList.remove('d-none');
                        data.forEach(element => {
                            html += `<tr>
                                        <td>
                                            ${element.student.id_no}
                                            <input type="hidden" name="student_id[]" value="${element.student_id}" />
                                        </td>
                                        <td>${element.student.name}</td>
                                        <td>${element.student.fname}</td>
                                        <td>${element.student.gender}</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="roll[]" value="${element.roll}">
                                        </td>
                                    </tr>`
                        });
                        document.getElementById('roll-generate-tr').innerHTML = html;
                    });
                }
            );
    })
</script>

@endsection

