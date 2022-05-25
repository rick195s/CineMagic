@extends('layouts.dashboard')
@section('title', __('Edit User'))

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update User') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.users.partials.create-edit')

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('User Photo') }}</label>

                            <div class="col-md-6 ">
                                <img src="{{$user->foto_url ? asset('storage/fotos/' .
$user->foto_url) : asset('img/default_img.png') }}" alt="Foto do utilizador" class="w-25 img-fluid rounded">
                            </div>

                        </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update User') }}
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