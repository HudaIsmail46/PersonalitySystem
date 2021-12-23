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
                            <form action="{{ route('question.store_settings') }}" method="post">
                                @csrf
                                {{-- <div class="row"> --}}
                                <!-- select -->
                                <div class="col-7">
                                    <label>Please specify the numbers of the question scales</label>
                                    <input class="form-control col-3  @error('scale') is-invalid @enderror" type="number"
                                        name="scale" id="scale"
                                        value="{{ old('scale') ?? ($questionSettings->scale ?? '') }}"
                                        placeholder="Questions Scales">
                                </div>
                                <div class="col-7 mt-2">
                                    <label>Please list out the scale description based on the question scales</label>
                                    <input class="form-control @error('scale_value') is-invalid @enderror" type="text"
                                        name="scale_value" id="scale_value"
                                        value="{{ old('scale_value') ?? ($questionSettings->scale_value[0]['Description'] ?? '') }}"
                                        placeholder="[Example: Agree, Neutral, Not Agree]">
                                </div>


                                {{-- </div> --}}
                                <button class="btn btn-primary bottom mb-2 mt-2 ml-2"
                                    onclick="return confirm('This changes will applies to all questions. Click \'OK\' to proceed')"
                                    type="submit">Save</button>
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
