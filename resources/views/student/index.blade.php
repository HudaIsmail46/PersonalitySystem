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
                                    <button class="btn btn-success btn-md ml-2 float-right" type="submit" name="submit" value="create">
                                        Register New Student <i class="fas fa-plus"> </i></button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Student Id</th>
                                        <th>Name</th>
                                        <th>Matric Number</th>
                                        <th>Faculty</th>
                                        <th>Department</th>
                                        <th>Programme</th>
                                        <th>Year In Progress</th>
                                        <th></th>
                                    </tr>
                                    {{-- @foreach ($Students as $Student) --}}
                                    <tr>
                                        <td>1</td>
                                        <td>Huda</td>
                                        <td>17146952/1</td>
                                        <td>Science Computer & Information Technology</td>
                                        <td>Information System</td>
                                        <td>Bachelor of Computer Science</td>
                                        <td>Year 3</td>
                                        <td><a href="" class='btn btn-primary mr-2'> <i class=" fas fa-edit"></i></a></td>

                                    </tr>
                                    {{-- @endforeach --}}

                                </table>
                                {{-- {{ $Students ?? ''->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
