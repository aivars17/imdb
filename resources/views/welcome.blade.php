@extends('layouts.app')

@section('content')
    <div class="container-fluid body-movies">
        <div class="row">
            <div class="col" style="background-color:white; border-bottom-color: #4e555b; padding-left: 40%">
                <form class="form-inline" action="{{ route('orderby') }}" method="get" style="box-shadow: 4px grey;">
                    <div class="form-group mb-2">
                    <select class="form-control" name="category" onchange="this.form.submit()">
                        <option {{ session('orderby_category') == 'all' ? 'selected' : ''  }} value="all">Categories</option>
                        @foreach($categories as $category)
                        <option  {{ session('orderby_category') == $category->name ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                    </div>
                        <div class="form-group mb-2">
                    <select name="a_z" class="form-control" onchange="this.form.submit()">
                            <option {{ session('orderby_a_z') == 'ASC' ? 'selected' : ''  }} value="ASC">A-Z</option>
                            <option {{ session('orderby_a_z') == 'DESC' ? 'selected' : ''  }} value="DESC">Z-A</option>
                    </select>
                        </div>
                <div class="form-group mb-2">
                    <select name="year" class="form-control" onchange="this.form.submit()">
                            <option {{ session('orderby_year') == 'ASC' ? 'selected' : ''  }} value="ASC">New</option>
                            <option {{ session('orderby_year') == 'DESC' ? 'selected' : ''  }} value="DESC">Old</option>
                    </select>
                </div>
                    <div class="form-group mb-2">
                    <select class="form-control" name="rating" onchange="this.form.submit()">
                        <option {{ session('orderby_rating') == '0' ? 'selected' : ''  }} value="0">Rating</option>
                        <option {{ session('orderby_rating') == '1' ? 'selected' : ''  }} value="1">1</option>
                        <option {{ session('orderby_rating') == '2' ? 'selected' : ''  }} value="2">2</option>
                        <option {{ session('orderby_rating') == '3' ? 'selected' : ''  }} value="3">3</option>
                        <option {{ session('orderby_rating') == '4' ? 'selected' : ''  }} value="4">4</option>
                        <option {{ session('orderby_rating') == '5' ? 'selected' : ''  }} value="5">5</option>
                        <option {{ session('orderby_rating') == '6' ? 'selected' : ''  }} value="6">6</option>
                        <option {{ session('orderby_rating') == '7' ? 'selected' : ''  }} value="7">7</option>
                        <option {{ session('orderby_rating') == '8' ? 'selected' : ''  }} value="8">8</option>
                        <option {{ session('orderby_rating') == '9' ? 'selected' : ''  }} value="9">9</option>
                        <option {{ session('orderby_rating') == '10' ? 'selected' : ''  }} value="10">10</option>
                    </select>
                    </div>
                </form>

            </div>
        </div>
        <div class="row movies-index">
            <div class="col">
                <div class="row" >
            @if(!empty(session('error')))
                <div  class="col" style="position: relative; height: 14rem;">
                        <p style="position: absolute; top: 50%; left:50%; transform: translate(-50%,-50%); font-size: 50px">{{ session('error') }}</p>
                </div>
            @else
                @foreach($movies as $movie)
                <div class="col-3" style=" border: #f1fffd 5px solid; margin-bottom: 5px; padding: 5px;background-color: black; border-radius: 10px;">
                    <div class="row">
                    <a class="col" href="{{ route('single_movie', [$movie->id, $movie->name]) }}"><img class="card-img-top" width="auto" height="100%"  src="{{ $movie->FeatureImage }}" alt="Card image cap"></a>
                    </div>
                        <div class="row" >
                        <h5 class="col" style="color: white" align="center"><strong>{{ $movie->name }}</strong></h5>
                    </div>
                    <div class="row">

                    </div>
                </div>
                    @endforeach

            @endif
                </div>
            </div>
        </div>
        <div class="row text-center" >
            <div class="col text-center"  style="padding-left: 40%">
                {{ $movies->links() }}
            </div>
        </div>
    </div>
    @endsection
