@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4" >
                <img width="100%" height="auto" src="{{ asset($movie->featureimage) }}">
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col"><h2><strong>{{ $movie->name }}</strong> ({{ $movie->year }})</h2></div>
                    <div class="col"><h6><img height="100%" width="30" src="https://openclipart.org/download/243661/1457652300.svg">  {{ $movie->rating }}/10</h6></div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col"><h4><strong>Storyline:</strong></h4></div>
                </div>
                <div class="row">
                    <div class="col" style="margin-top: 13px">
                        <p style="font-size: 20px;">{{ $movie->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Cast</h3>
                <div class="row">
                    @foreach($actors as $actor)
                    <div class="col"><a href="{{ route('single_actor', $actor->id) }}"> <h6><img height="100%" width="50px" src="{{ asset($actor->featureimage) }}"> {{ $actor->name }} </h6></a></div>
                        @endforeach
                </div>
            </div>
                <div class="col">
                    @Auth()
                    <h3>Gallery</h3><a href="{{ route('upload', [$movie->id, 'movie']) }}">Add photo</a>
                    @endAuth
                        <div class="row">
                        @foreach($movie->image as $image)
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
        <div class="row">
            <div class="col">
                <h3>Same category movie</h3>
                <div class="row">
                    @foreach($movies_by_category as $movie_by_category)
                        @if($movie_by_category->id == $movie->id)
                            @else
                        <div class="col">
                            <div class="card" style="margin-bottom:5px;width: 18rem;">
                                <a href="{{ route('single_movie', [$movie_by_category->id, $movie_by_category->name]) }}"><img class="card-img-top" width="auto" height="100%"  src="{{ $movie_by_category->FeatureImage }}" alt="Card image cap"></a>
                                <div class="" >
                                    <h5 align="center"><strong>{{ $movie_by_category->name }}</strong></h5>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    @endsection