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
                            <h4 class="box-title">Manage <strong>Monthly / Yearly Profit</strong></h4>
                        </div>
                        <div class="box-body">
                            @csrf
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Start Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="start_date" id="start_date" class="form-control" >
                                        </div>
                                        @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>End Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="end_date" id="end_date" class="form-control" >
                                        </div>
                                        @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a id="search" name="search" class="btn btn-info" style="margin-top:25px">Search</a>
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
                                                <tr>
                                                    @{{{tdsource}}}
                                                </tr>
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
        let start_date = document.getElementById('start_date').value;
        let end_date = document.getElementById('end_date').value;
        if (!start_date || !end_date) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select date!',
            });
            return;
        }
        let url = new URL("{{ route('profit.date.get') }}");
        let param = {
            start_date: start_date,
            end_date: end_date,
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

