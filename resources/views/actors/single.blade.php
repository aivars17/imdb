@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4" >
                <img width="100%" height="auto" src="{{ asset($actor->featureimage) }}">
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col"><h2><strong>{{ $actor->name }}</strong></h2></div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col"><h5><strong>Born:</strong> {{ $actor->birthday }}</h5></div>
                </div>
                @if($actor->deathday !== null)
                <div class="row">
                    <div class="col" style="margin-top: 13px">
                        <p style="font-size: 20px;"><h5><strong>Deathday:</strong> {{ $actor->deathday }}</h5></p>
                    </div>
                </div>
                    @endif
                <div class="row">

                    <div class="col" >
                        <h3>Actor photos</h3><a style="margin-bottom: 10px;" class="btn btn-success" href="{{ route('upload', [$actor->id, 'actor']) }}">Add photo</a>
                        <div class="row">
                            @foreach($actor->image as $image)
                                <div class="col" style="height: 200px;width: 100%;"><img onclick="show('{{ 'img'.$image->id }}')" id="{{ 'img'.$image->id }}" width="auto" height="100%" alt="{{ $image->filename }}" src="{{ asset('storage/image/'.$image->filename) }}"></div>
                        @endforeach
                        <!-- Trigger the Modal -->

                            <!-- The Modal -->
                            <div id="myModal" class="modal">

                                <!-- The Close Button -->
                                <span class="close">&times;</span>

                                <!-- Modal Content (The Image) -->
                                <img class="modal-content" id="img01">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h3>Same category movie</h3>
                <div class="row">
                    @foreach($movies as $movie)
                        {{--@if($movie_by_category->id == $actor->id)--}}
                        {{--@else--}}
                            <div class="col">
                                <div class="card" style="margin-bottom:5px;width: 18rem;">
                                    <a href="{{ route('single_movie', [$movie->id, $movie->name]) }}"><img class="card-img-top" width="auto" height="100%"  src="{{ $movie->FeatureImage }}" alt="Card image cap"></a>
                                    <div class="" >
                                        <h5 align="center"><strong>{{ $movie->name }}</strong></h5>
                                    </div>
                                </div>
                            </div>
                       {{--@endif--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection