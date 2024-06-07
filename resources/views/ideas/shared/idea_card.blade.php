<div class="mt-3">
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageUrl() }}"
                        alt="Mario Avatar">
                    <div>
                        <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user) }}">
                                {{ $idea->user->name }}
                            </a></h5>
                    </div>
                </div>

                <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                    <a href="{{ route('ideas.show', $idea->id) }}">View</a>
                    <button class="ms-2 btn btn-danger btn-sm">X</button>
                </form>

            </div>
        </div>
        <div class="card-body">
            @if ($editing ?? false)
                <form method="POST" action="{{ route('ideas.update', $idea->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                        @error('content')
                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark btn-sm mb-2"> Update </button>
                    </div>
                </form>
            @else
                <p class="fs-6 fw-light text-muted">
                    {{ $idea->content }}
                </p>
            @endif
            <div class="d-flex justify-content-between">
        
                    @include('ideas.shared.like-button')

                <div>
                    <span class="fs-6 fw -light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $idea->created_at }} </span>
                </div>
            </div>
            @include('shared.comment-box')
        </div>

    </div>
</div>
