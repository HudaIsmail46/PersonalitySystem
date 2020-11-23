@foreach ($images as $image)
    <img src="{{ asset('/storage/' . $image->file ?? '') }}" alt=""
        class="img-thumbnail">
    <p>{{$image->caption}}</p>
    @if ($image != null)
        <form class='mb-0' action="{{ route('image.destroy') }}"
            method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name='image_id' value="{{$image->id}}">
            <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                type="submit">Delete Image <i class="fa fa-trash"></i>
            </button>
        </form>
    @endif
@endforeach