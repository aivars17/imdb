@extends('layouts.app')

@section('content')
    <a href="{{ route('upload', [$movie->id, 'movie']) }}">Add photo</a>

    {{ $movie->name }}


    @endsection