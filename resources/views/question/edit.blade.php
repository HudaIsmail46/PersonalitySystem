@extends('layouts.app')

@section('title', 'Page Title')

    <title>Edit Question</title>
    
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Edit Questions</h3>
                </div>
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('question.update', $question->id)}}">
                           @csrf
                           @method('PUT')
                           <div class="field" id="form">
                             <h3>Question</h3>
                            <div class="mb-5 mt-2">
                                
                                <div class="field">
                                    <label class="label" for="question_text">Question Text <span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input class="form-control @error('question_text') is-invalid @enderror"
                                                type="text" name="question_text" id="question_text"
                                                value="{{ $question->question_text ?? old('question_text') }}" placeholder="Type the question here">
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
                                                @foreach ($categories as $question_category)
                                                    <option value="{{ $question_category->id }}"
                                                        {{ $question->question_category == $question_category->id ? 'selected' : '' }}>{{ $question_category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('question_category') }}</div>
                                        </div>
                                    </div>
                                </div>
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
