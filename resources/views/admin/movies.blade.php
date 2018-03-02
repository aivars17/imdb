@extends('admin.dashboard')

@section('admin')

    <div class="container">
            <form action="{{ !empty($data) ? route('movie_update', $data->id) : route('movie_save') }}" method="post">
                @csrf
                <div class="form-group">
                <label for="categories">Categories</label>
                <select name="category_id" class="form-control col-2" id="exampleFormControlSelect1">
                    @foreach($cats as $cat)
                        <option  value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="row">

                <div class="form-group col">
                    <label for="formGroupExampleInput">Movie</label>
                    <br>
                    <input class="col-10" type="text" class="form-control" value="{{ !empty($data) ? $data->name : '' }}" name="name" id="formGroupExampleInput" >
                </div>
                <div class="form-group col">
                    <label for="formGroupExampleInput">Year</label>
                    <br>
                    <input class="col-10" type="text" class="form-control" value="{{ !empty($data) ? $data->year : '' }}" name="year" id="formGroupExampleInput" >

                </div>
                    <div class="form-group col">
                        <label for="formGroupExampleInput">Rating</label>
                        <br>
                        <input class="col-10" type="text" class="form-control" value="{{ !empty($data) ? $data->rating : '' }}" name="rating" id="formGroupExampleInput" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="6">{{ !empty($data) ? $data->description : '' }}</textarea>
                </div>
                @if(!isset($data))
                <button type="submit" class="btn btn-primary">Save</button>
                @else
                    <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('moviesMoviesSeeder') }}" class="btn btn-primary">New</a>
                @endif
            </form>

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                This is a {{session('status')}} !!!
            </div>
        @endif
    </div>

    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cover</th>
            <th scope="col">Movie</th>
            <th scope="col">Description</th>
            <th scope="col">Year</th>
            <th scope="col">Rating</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td><img width="100" height="100" src="{{ $movie->FeatureImage }}"></td>
                <td>{{ $movie->name }}</td>
                <td>{{ str_limit($movie->description, 100) }}</td>
                <td>{{ $movie->year }}</td>
                <td>{{ $movie->rating }}</td>
                <td><a href="{{ route('upload', [$movie->id, 'movie']) }}">Image</a></td>
                <td><a href="{{ route('movie_edit', $movie->id) }}">Edit</a></td>
                <td><a href="{{ route('movie_delete', $movie->id) }}">Delete</a> </td>


            </tr>
        @endforeach
        </tbody>
    </table>
    @endsection