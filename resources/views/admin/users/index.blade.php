@extends('layouts.dashboard')

@section('title', __('Users'))
@section('content')

<div class="container-fluid p-0">


    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3"><strong>{{__('Users')}}</strong></h1>
        </div>

        @can('create', App\Models\User::class)
        <div class="col-6  d-flex justify-content-end align-items-start">
            <a href="{{ route('admin.users.create')}}" class="btn btn-success"><i class="align-middle"
                    data-feather="user-plus"> </i> {{__('Add User')}}</a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-12  d-flex">
            <div class="card flex-fill">

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th class="d-none d-xl-table-cell">Email</th>
                            <th class="d-none d-xl-table-cell">{{__('Type')}}</th>
                            <th>{{__('State')}}</th>
                            <th>{{__('Edit')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td class="d-none d-xl-table-cell">{{ $user->email }}</td>
                            <td class="d-none d-xl-table-cell">{{ $user->tipo }}</td>
                            <td>
                                @can('updateState', $user)
                                <form action="{{ route('admin.users.update_state', $user->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="state" value="{{ !$user->estado }}">

                                    @if ($user->bloqueado)

                                    <button class="btn btn-success">{{ __('Unlock') }}</button>

                                    @else

                                    <button class="btn btn-warning"> {{__('Block') }} </button>

                                    @endif
                                </form>
                                @endcan
                            </td>
                            <td>
                                @can('update', $user)

                                <a href="{{ route('admin.users.edit', $user->id)}}" class="btn btn-info"><i
                                        data-feather="edit"></i> </a>
                                @endcan

                                @can('delete', $user)

                                <button form="delete_user_{{$user->id}}" class="btn btn-danger"><i
                                        data-feather="trash-2"></i> </button>

                                <form id="delete_user_{{$user->id}}"
                                    action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                </form>
                                @endcan


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection