@extends('admin.dashboard')

@section('admin')
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}} !!!
        </div>
    @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Role</th>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="post" action="{{ route('admin_role', $user->id) }}">
                            @csrf
                        <select onchange="this.form.submit()" name="user_role">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        </form>
                    </td>
                    <td><a href="{{ route('user_delete', $user->id) }}">Delete</a></td>
                </tr>

            @endforeach

            </tbody>
        </table>
@endsection