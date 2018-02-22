@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{ route('category_save') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Category name</label>

            <input class="col-2" type="text" class="form-control" name="name" id="formGroupExampleInput" >
        </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="6"></textarea>
    </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        @if(isset($status))
            <div class="alert alert-success" role="alert">
                This is a success!!!
            </div>
            @endif
    </div>
    @endsection