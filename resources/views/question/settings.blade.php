@extends ('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Question Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('question.index') }}">All Question</a></li>
                        <li class="breadcrumb-item active">Question Settings</li>
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
                                <h3 class="mb-0">Question Settings Detail</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('question.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <!-- select -->
                                    <div class="col-4 form-group">
                                        <label>Please specify the numbers of the question scales</label>
                                        <select class="custom-select cc_cursor col-sm-3">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-3">
                                    </div> --}}
                                    <div class="col-5 form-group">
                                        <label>Select the question dimensions you wish to change. [Can select more than
                                            one]</label>
                                        <select multiple="" class="form-control">
                                            <option>Integrity</option>
                                            <option>Emotional Intelligence</option>
                                            <option>Adaptability</option>
                                            <option>Mindfulness</option>
                                            <option>Resilience</option>
                                            <option>Communication</option>
                                            <option>Teamwork</option>
                                            <option>Creativity</option>
                                        </select>
                                    </div>

                                </div>
                                <button class="btn btn-primary bottom mb-2 mt-2" type="submit">Save</button>
                            </form>
                            <div class="row ml-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
