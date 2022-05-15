@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                @foreach ($users as $user)
                {{ $user->name }}
                @endforeach
            </div>

            {{ $users->links() }}

        </div>
    </div>
</div>
@endsection