@extends('layout.layout')

@section('content')
    <div class="row">
       @include("shared.left_sidebar")
        <div class="col-6">
            @include('shared.success_message')
            <hr>
            <div class="mt-3">
                @include('ideas.shared.idea_card')
            </div>
        </div>
    </div>
@endsection
