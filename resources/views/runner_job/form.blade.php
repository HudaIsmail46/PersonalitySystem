@if ($runnerJob->completed_at == '')
    <tr>
        <td><label class="label" for="image">Image</label></td>
        <td>
            <form action="{{ route('runner_job.complete', $runnerJob->id) }}" enctype="multipart/form-data"
                method="post">
                @csrf
                @method('PUT')
                <input class="input @error('image') is-danger @enderror" type="file" name="image" id="image">
                @error('image')
                    <p class="help is-danger">{{ $errors->first('image') }}</p>
                @enderror
        </td>
    </tr>
    <tr>
        <tfoot>
            <td>
                <button class="btn btn-success mr-2" type="submit">Complete</button>
                </form>
            </td>
        </tfoot>
    </tr>
@elseif ($runnerJob->images->count() >= 0)
    <tr>
        <td>Image</td>
        <td>
            @foreach ($runnerJob->images as $image)
                <img src="{{ asset('/storage/' . $image->file) }}" alt="" class="img-thumbnail">
                    <form class='mb-0' action="{{ route('runner_job.destroyImage', $image->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm d-flex " onclick="return confirm('Are you sure?')"
                            type="submit">Delete Image<i class="fa fa-trash"></i></button>
                    </form>
            @endforeach
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <form action="{{ route('runner_job.complete', $runnerJob->id) }}" enctype="multipart/form-data"
                method="post">
                @csrf
                @method('PUT')
                <div
                    class="dropzone border border-info rounded"
                    id="dropzone"
                    data-token="{{csrf_token()}}"
                    data-imageableid="{{$runnerJob->id}}"
                    data-imageabletype="{{App\RunnerJob::class}}">
                            </div><br>
                <button class="btn btn-success btn-sm " type="submit">Submit</button>
        </td>
    </tr>
@else
    <tr>
        <td>Image</td>
        <td>
            @foreach ($runnerJob->images as $image)
                <img src="{{ asset('/storage/' . $image->file) }}" alt="">
            @endforeach
        </td>
    </tr>
@endif
