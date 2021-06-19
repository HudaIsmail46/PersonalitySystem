@extends ('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <h3 class="mb-0">All Students</h3>

                                <form class='mb-0 ml-auto' action="{{ route('student.create') }}" method="get">
                                    @csrf
                                    <button class="btn btn-success btn-md ml-2 float-right" type="submit" name="submit"
                                        value="create">
                                        Register New Student</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table mt-4 table-bordered yajra-datatable w-100" id="usersTable">
                                <thead>
                                    <th> # </th>
                                    <th>Matric Number</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Programme</th>
                                    <th>Year In Progress</th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#usersTable').DataTable({
                // processing: true,
                serverSide: true,
                ajax: "{{ route('student.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'matric_no',
                        name: 'matric_no'
                    },
                    {
                        data: 'faculty',
                        name: 'faculty'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'programme',
                        programme: 'name'
                    },
                    {
                        data: 'year_in_progress',
                        name: 'year_in_progress'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

    </script>
@endsection
