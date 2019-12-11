<label for="Comment" class="m-2">Comment</label>
<form action="{{ route('comments.store', $post->id) }}" method="post" class="d-flex">
    @csrf
    <textarea name="content" id="Comment"  rows="5"
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
@foreach ($comments as $coment)
<div class="border m-2 p-2">
    {{ $coment->content }}
</div>
@endforeach
