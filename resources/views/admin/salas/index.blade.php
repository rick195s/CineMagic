@extends('layouts.dashboard')
@section('title', __('Movie Theaters'))
@section('content')

<div class="col-12 col-md-6">
    <div class="card">
        <img class="card-img-top" src="img/photos/unsplash-2.jpg" alt="Unsplash">
        <div class="card-header">
            <h5 class="card-title mb-0">Card with image and button</h5>
        </div>
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>

@endsection