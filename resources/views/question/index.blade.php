@extends ('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Questions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Questions</li>
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
                                <h3 class="mb-0">Question Detail</h3>
                                <form class='mb-0 ml-auto' action="{{ route('question.create') }}" method="get">
                                    @csrf
                                    <button class="btn btn-success btn-md ml-2 float-right" type="submit" name="submit" value="create">
                                        Add New Questions <i class="fas fa-plus"> </i></button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                            <div class="row ml-0">
                            </div>
                                <table class="table mt-4 table-bordered yajra-datatable w-100" id="usersTable">
                                    <thead>
                                        <th> # </th>
                                        <th>Questions</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        var table = $('#usersTable').DataTable({
                                            // processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('question.index') }}",
                                            columns: [
                                                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                                {data: 'question_text', name: 'question_text'},
                                                {data: 'question_category', name: 'question_category'},
                                                {data: 'action', name: 'action', orderable: false, searchable: false},
                                            ]
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
