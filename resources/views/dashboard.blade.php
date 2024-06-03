@extends('layout.layout')

@section('content')
    <div class="row">
        @include('shared.left_sidebar')
        <div class="col-6">
            @include('shared.success_message')
            @include('shared.submit_idea')
            <hr>
            @foreach ($ideas as $idea)
                @include('shared.idea_card')
            @endforeach
            <div class="mt-3">
                {{ $ideas->links() }}
            </div>

        </div>
        <div class="col-3">
           @include('shared.search_bar')
          @include('shared.follow_card')
        </div>
    </div>
@endsection
