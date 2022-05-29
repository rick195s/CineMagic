@extends('layouts.dashboard')
@section('title', __('Update Movie Theater'))
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Movie Theater') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.salas.update', $sala->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('admin.salas.partials.create-edit')
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Movie Theater') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection