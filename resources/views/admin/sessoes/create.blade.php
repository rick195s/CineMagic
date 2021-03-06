@extends('layouts.dashboard')
@section('title', __('Add Session'))
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Session') }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.sessoes.store') }}" method="post">
                            @csrf

                            @include('admin.sessoes.partials.create-edit')

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Session') }}
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
