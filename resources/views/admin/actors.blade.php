@extends('admin.dashboard')

@section('admin')

    <div class="container">
        <form action="{{ !empty($actor) ? route('actor_update', $actor->id) : route('actor_save') }}" method="post">
            @csrf

            <div class="row">

                <div class="form-group col">
                    <label for="formGroupExampleInput">Name</label>
                    <br>
                    <input class="col-10" type="text" class="form-control" value="{{ !empty($actor) ? $actor->name : '' }}" name="name" id="formGroupExampleInput" >
                </div>
                <div class="form-group col">
                    <label for="formGroupExampleInput">Born</label>
                    <br>
                    <input class="col-10" type="text" class="form-control" placeholder="1991-01-01" value="{{ !empty($actor) ? $actor->birthday : '' }}" name="birthday" id="formGroupExampleInput" >

                </div>
                <div class="form-group col">
                    <label for="formGroupExampleInput">Dead</label>
                    <br>
                    <input class="col-10" type="text" class="form-control" placeholder="1991-01-01" value="{{ !empty($actor) ? $actor->deathday : '' }}" name="deathday" id="formGroupExampleInput" >
                </div>

            </div>
<div class="row">
    <div class="col">
    <select class="js-example-basic-multiple col" name="states[]" multiple="multiple">
        @foreach($movies as $movie)
            <option @isset($actor_movie) @if(($actor_movie->contains($movie))) selected @endif @endisset value="{{ $movie->id }}">{{ $movie->name }}</option>
        @endforeach
    </select>
</div>
</div>
            <br>

            @if(!isset($actor))
                <button type="submit" class="btn btn-primary">Save</button>
            @else
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('actors') }}" class="btn btn-primary">New</a>
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
            <th scope="col">Name</th>
            <th scope="col">Birhday</th>
            <th scope="col">Deathday</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($actors as $actor)
            <tr>
                <td><img height="100" width="100" src="{{ $actor->FeatureImage }}"></td>
                <td>{{ $actor->id }}</td>
                <td>{{ $actor->name }}</td>
                <td>{{ $actor->birthday }}</td>
                <td>{{ $actor->deathday }}</td>
                <td><a href="{{ route('upload', [$actor->id, 'actor']) }}">Image</a></td>
                <td><a href="{{ route('actor_edit', $actor->id) }}">Edit</a></td>
                <td><a href="{{ route('actor_delete',$actor->id) }}">Delete</a> </td>


            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row"><div class="col" align="center"><div class="row"><div class="col" style="text-align: center">
                {{ $actors->links() }}
            </div></div></div></div>

@endsection