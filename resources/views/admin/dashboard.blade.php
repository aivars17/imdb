@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="row">
                    <h2>Admin panel</h2>
                    <ul>
                        <li><a href="{{ route('edit_users') }}">Users</a></li>
                        <li><a href="{{ route('movies') }}">Movies</a></li>
                        <li><a href="{{ route('actors') }}">Actors</a></li>
                        <li><a href="{{ route('create_category') }}">Categories</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-10">
                @yield('admin')
            </div>
        </div>
    </div>
    @endsection