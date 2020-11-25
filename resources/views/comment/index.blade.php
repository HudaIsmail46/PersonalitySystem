<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Comments</h3>
    </div>
    <div class="card-body p-1 text-capitalize">
        <div class="item">
            @foreach ($model->comments->sortBy('created_at') as $comment)
                <img class="direct-chat-img" src={{ asset('img/cleanherologo100.png') }}
                    alt="User Image">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>
                            {{ myShortDateTime(new Carbon\Carbon($comment->created_at)) }}  
                        </small>
                        {{ $comment->user->name }} 
                            @foreach($comment->user->roles()->get() as $role)
                                <small class="text-muted">( {{ $role->name }} )</small>
                            @endforeach
                    </a>
                    @if ($comment->user_id == Auth()->user()->id)
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn float-right"
                                onclick="return confirm('Delete this message?')" type="submit"><i
                                    class="fa fa-times"></i></button>
                        </form>
                    @endif
                </p>
                <p class="ml-3"> {{ $comment->comment }}</p>
            @endforeach
        </div>
    </div>

    <div class="card-footer">
        <form action="{{ route('comment.store') }}" method="post">
            @csrf
            <div class="input-group">
                <input type="hidden" name="commentable_id" value={{ $model->id }}>
                <input type="hidden" name="commentable_type" value = {{ $appName}}>
                <input class="form-control" name="comment" placeholder="Type message...">
                <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-plus"></i></button>
            </div>
        </form>
    </div>
</div>
