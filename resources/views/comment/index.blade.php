<div class="col-md-5 mx-auto ">
    <div class="card mt-4 ">
        <div class="card-header text-center">
            <h5>
                <i class="fa fa-comments-o"></i> Chat
            </h5>
        </div>
        <div class="card-body">
            <div class="item">
                @foreach ($model->comments as $comment)
                    <img class="direct-chat-img" src={{ asset('img/cleanherologo100.png') }}
                        alt="User Image">
                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>
                                {{ $comment->created_at }}</small>
                            {{ $comment->user->name }}
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
                    <p> {{ $comment->comment }}</p>
                @endforeach
            </div>
        </div>

        <div class="card-footer">
            <form action="{{ route('comment.store') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="hidden" name="commentable_id" value={{ $model->id }}>
                    <input type="hidden" name="commentable_type" value = {{$model}}>
                    <input class="form-control" name="comment" placeholder="Type message...">
                    <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>