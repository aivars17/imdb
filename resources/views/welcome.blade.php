@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
                @foreach($movies as $movie)
                <div class="col">
                <div class="card" style="margin-bottom:5px;width: 18rem;">
                    <a href="{{ route('single_movie', [$movie->id, $movie->name]) }}"><img class="card-img-top" width="100" height="300"  src="{{ $movie->FeatureImage }}" alt="Card image cap"></a>
                    <div class="" >
                        <h5 align="center"><strong>{{ $movie->name }}</strong></h5>
                    </div>
                </div>
                </div>
                    @endforeach

        </div>
    </div>
    @endsection
