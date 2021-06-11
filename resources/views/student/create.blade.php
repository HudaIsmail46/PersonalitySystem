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
                  
                          <div class="mb-5 mt-2">
                              <h3>Question</h3>
                              <div class="field">
                                  <label class="label" for="event_begins">Event Begins <span class="text-danger">*</span></label>
                                  <div class="form-group row mx-0">
                                      <div class="col-xs-4">
                                          <input class="form-control @error('event_begins') is-invalid @enderror" type="datetime-local"
                                              name="event_begins" id="event_begins" value="{{ old('event_begins') }}">
                                          <div class="invalid-feedback">{{ $errors->first('event_begins') }}
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      
                              <div class="field">
                                  <label class="label" for="event_ends">Event Ends <span class="text-danger">*</span></label>
                                  <div class="form-group row mx-0">
                                      <div class="col-xs-4">
                                          <input class="form-control @error('event_ends') is-invalid @enderror" type="datetime-local"
                                              name="event_ends" id="event_ends" value="{{ old('event_ends') }}">
                                          <div class="invalid-feedback">{{ $errors->first('event_ends') }}
                                          </div>
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