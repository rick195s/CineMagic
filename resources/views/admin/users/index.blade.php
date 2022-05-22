@extends('layouts.dashboard')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Editar</th>
                </tr>
                @foreach ($users as $user)

                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tipo  }}</td>
                    <td>
                        <form action="{{ route('admin.users.update_state', $user->id)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="state" value="{{ !$user->estado }}">
                            <input type="submit" value="{{ $user->bloqueado ? __('Unlock') : __('Block') }}">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="{{__('Delete User')}}">
                        </form>

                    </td>
                </tr>
                @endforeach


            </table>
        </div>

    </div>
    {{ $users->links() }}

</div>
@endsection