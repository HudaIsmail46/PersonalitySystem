@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Question</title>
    
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create Questions</h3>
                </div>
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="inner">
                    <div class="card-body">
                        <form method="post" action="{{route('question.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="field" id="form">
                             <h3>Question</h3>
                            <div class="mb-5 mt-2">
                                
                                <div class="field">
                                    <label class="label" for="question_text">Question Text <span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input class="form-control @error('question_text') is-invalid @enderror"
                                                type="text" name="question_text" id="question_text"
                                                value="{{ old('question_text') }}" placeholder="Type the question here">
                                            <div class="invalid-feedback">{{ $errors->first('question_text') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="question_category">Category<span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col">
                                            <select id="question_category" name="question_category"
                                                class="custom-select @error('question_category') is-invalid @enderror">
                                                <option value="">--SELECT CATEGORY TYPE--</option>
                                                @foreach (App\Question::CATEGORIES as $question_category)
                                                    <option value="{{ $question_category }}"
                                                        {{ old('question_category') == $question_category ? 'selected' : '' }}>{{ $question_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('question_category') }}</div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="field">
                                    <label class="label" for="scale_number">Scale Number<span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input class="form-control @error('scale_number') is-invalid @enderror"
                                                type="number" name="scale_number" id="scale_number"
                                                value="{{ old('scale_number') ?? 5}}" placeholder="Type the question here">
                                            <div class="invalid-feedback">{{ $errors->first('scale_number') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="score">Score<span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input class="form-control @error('score') is-invalid @enderror"
                                                type="number" name="score" id="score"
                                                value="{{ old('score') ?? 1}}" placeholder="Type the question here">
                                            <div class="invalid-feedback">{{ $errors->first('score') }}</div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
