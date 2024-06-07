@extends('layout.layout')

@section('content')
    <div class="row">
        @include('shared.left_sidebar')
        <div class="col-6">
            @include('shared.success_message')

            @include('shared.user-edit-card')

            @forelse ($ideas as $idea)
                @include('ideas.shared.idea_card')
            @empty
                <p class="text-center my-3">No Results Found</p>
            @endforelse
            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search_bar')
            @include('shared.follow_card')
        </div>
    </div>
@endsection
