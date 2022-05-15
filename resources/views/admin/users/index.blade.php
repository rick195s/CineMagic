@extends('layouts.dashboard')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped">
                <tr>
                    <th>Nome</th>
                    <th>Editar</th>
                </tr>
                @foreach ($users as $user)

                <tr>
                    <td>{{ $user->name }}</td>
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