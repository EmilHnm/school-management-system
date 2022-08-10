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
                            <h4 class="box-title">Add <strong>Student Fee</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Date </h5>
                                        <input type="date" name="date" id="date" class="form-control">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a id="search" name="search" class="btn btn-info" style="margin-top:25px">Search</a>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div id="documentResult">
                                </div>
                                <script id="document-template" type="text/x-handlebars-template">
                                    <form method="post" action="{{ route('account.salary.store') }}">
                                        @csrf
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
                                        <input type="submit" class="btn btn-info" value="Submit">
                                    </form>
                                </script>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    document.getElementById('search').addEventListener('click', (e) => {
        let date = document.getElementById('date').value;
        if (!date) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select date!',
            });
            return;
        }
        let url = new URL("{{ route('account.salary.getemployee') }}");
        let param = {
            date: date,
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

