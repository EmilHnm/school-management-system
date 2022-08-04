@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Student <strong>Marks Entry</strong></h4>
                        </div>
                        <div class="box-body">
                            <form method="post" action="{{ route('marks.entry.update') }}">
                                @csrf
                                <div class="row" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Year </h5>
                                            <select name="year_id" id="year_id"  class="form-control">
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ?  "selected" : '' }}>{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('year_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Class </h5>
                                            <select name="class_id" id="class_id"  class="form-control">
                                                <option value="" disabled selected>Please select a class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" {{ (@$class_id == $class->id) ?  "selected" : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Subject </h5>
                                            <select name="assign_subject_id" id="assign_subject_id"  class="form-control">
                                                <option value="" disabled selected >Select Subject</option>
                                            </select>
                                            @error('assign_subject_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Exam Type </h5>
                                            <select name="exam_type_id" id="exam_type_id"  class="form-control">
                                                <option value="" disabled selected >Please select a exam type</option>
                                                @foreach ($exam_types as $exam_type)
                                                    <option value="{{ $exam_type->id }}" >{{ $exam_type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('exam_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a id="search" name="search" class="btn btn-info" style="margin-top:25px">Search</a>
                                    </div>
                                </div>
                                <div class="row d-none" id="marks-entry">
                                    <div class="col-md-12">
                                        <table class="table table-border table-striped" id="example1" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID No</th>
                                                    <th>Student Name</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>
                                                    <th>Mark</th>
                                                </tr>
                                            </thead>
                                            <tbody id="marks-entry-tr">

                                            </tbody>
                                        </table>
                                        <input type="submit" class="btn btn-rounded btn-info"  value="Update">
                                    </div>
                                </div>
                                {{-- <input type="submit" class="btn btn-info" value="Roll Generate"> --}}
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
        let assign_subject_id = document.getElementById('assign_subject_id').value;
        let exam_type_id = document.getElementById('exam_type_id').value;
        let url = new URL("{{ route('marks.edit.getstudents') }}");
        let param = {
            year_id: year_id,
            class_id: class_id,
            assign_subject_id: assign_subject_id,
            exam_type_id: exam_type_id
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
                        document.getElementById('marks-entry').classList.remove('d-none');
                        data.forEach(element => {
                            html += `<tr>
                                        <td>
                                            ${element.student.id_no}
                                            <input type="hidden" name="id[]" value="${element.id}" />
                                        </td>
                                        <td>${element.student.name}</td>
                                        <td>${element.student.gender}</td>
                                        <td>${element.student.dob}</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="marks[]" value="${ element.marks }">
                                        </td>
                                    </tr>`
                        });
                        document.getElementById('marks-entry-tr').innerHTML = html;
                    });
                }
            );
    });

    document.getElementById('class_id').addEventListener('change', (e) => {
        let url = new URL("{{ route('marks.getsubject') }}");
        let param = {
            class_id : e.target.value
        };
        url.search = new URLSearchParams(param).toString();
        fetch(url , { "method": "GET",})
            .then(
                function(response) {
                    if (response.status != 200) {
                        console.error('Status Code: ' + response.status);
                        return;
                    }
                    response.json().then(function(data) {
                        //console.log(data);
                        let html = `<option value="" selected disabled>Select Subject</option>`;
                        data.forEach(element => {
                            html += `<option value="${element.school_subject.id}">${element.school_subject.name}</option>`
                        });
                        document.getElementById('assign_subject_id').innerHTML = html;
                    });
                }
            );
    });
</script>

@endsection

