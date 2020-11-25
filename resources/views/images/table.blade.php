<div>
    @foreach ($images as $image)
        <div class="row mt-2">
            <div class="col-8">
                <a href="{{ asset('/storage/' . $image->file) }}" target="_blank">
                    <img src="{{ asset('/storage/' . $image->file) }}"
                    alt=""
                    class="img-thumbnail img-responsive">
                </a>
            </div>
            <div class='col-4'>
                <div class="d-flex flex-column my-auto">
                    <p>{{$image->caption}}</p>
                    <br>
                    @if($can_delete_image)
                    <form class='mb-0' action="{{ route('image.destroy') }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name='image_id' value="{{$image->id}}">
                        <button class="btn btn-danger mt-auto" onclick="return confirm('Are you sure?')"
                            type="submit">Delete <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
