<label for="Comment" class="m-2">Comment</label>
<form action="{{ route('comments.store', $post->id) }}" method="post" class="d-flex">
    @csrf
    <textarea name="content" id="Comment" rows="5"
        class="form-control border ml-2 @error('content') is-invalid @enderror" placeholder="Comment">
        {{ old('content') }}
    </textarea>
    <button type="submit" class="btn btn-secondary mr-2">comment</button>
    @error('content')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</form>

<div class="mt-4 d-flex justify-content-center">
    {{ $comments->links() }}
</div>
@foreach ($comments as $comment)
<div class="border m-2 p-2 d-flex justify-content-between align-items-center">
    <div class="mr-2">
        {{ $comment->user->name }}
    </div>
    <div class="mr-2">
        {{ $comment->content }}
    </div>
    @can('delete', $comment)
    <button type="button" onclick="comment_delete({{ $comment->id }})" class="btn btn-danger">Del</button>
    @endcan
</div>
@endforeach
