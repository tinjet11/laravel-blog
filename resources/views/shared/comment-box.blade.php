<div>
    <form action="{{ route('ideas.comments.store', $idea->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="comment" class="fs-6 form-control" rows="1"></textarea>
            @error('comment')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
        </div>
        <hr>

        @forelse ($idea->comments as $comment)
            <div class="d-flex align-items-start">
                <img style="width:35px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageUrl() }}"
                    alt="Luigi Avatar">
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h5 class="">{{ $comment->user->name }}
                        </h6>
                        <small class="fs-6 fw-light text-muted">{{ $comment->created_at }}</small>
                    </div>
                    <p class="fs-6 mt-2 fw-bold">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>

        @empty
            <p class="text-center my-3">No Comments Found</p>
        @endforelse

    </form>

</div>
