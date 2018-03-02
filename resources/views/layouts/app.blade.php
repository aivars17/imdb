<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Imdb') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


</head>
<body>

<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags">
</div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Imdb') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <form>
                            <meta name="csrf-token" content="{{ Session::token() }}">
                            <input  id="search_text">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                    @guest
                        <li><a style="background-color: dodgerblue; padding: 10px; margin-bottom: 2px; border-radius: 5px; color: white; font-weight: bold" href="{{ route('facebook.redirect') }}"><i style="color: dodgerblue; border-radius: 3px; background-color: white; padding: 6px; margin-top: 2px; position:relative" class="fa fa-facebook fa-lg" aria-hidden="true"></i>  Login with Facebook</a></li>

                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                            <li><a class="nav-link" href="{{ route('admin') }}">Admin panel</a></li>
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <div class="container-fluid footer-copyright">
        <div class="wrapper row5">
            <div id="copyright" class="hoc clear">
                <div class="row">
                <div class="col" style="text-align: center"><div> Copyright &copy; 2016 - All Rights Reserved - <a href="#">Sevskis</a></div></div>
                </div>
            </div>
        </div>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



    <script>$(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        // Get the modal

            function show(n) {
                var modal = document.getElementById('myModal');

                // Get the image and insert it inside the modal - use its "alt" text as a caption

                var img = document.getElementById(n);
                console.log(img.src);
                var modalImg = document.getElementById("img01");
                modal.style.display = "block";
                modalImg.src = img.src;


                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on <span> (x), close the modal
                span.onclick = function () {
                    modal.style.display = "none";
                }
            }





        function search(){

                console.log(document.getElementById('search_text').value);



            var dataId = document.getElementById('search_text').value;
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({

                type:'POST',
                url:"{!! URL::to('test') !!}",
                dataType: 'JSON',
                data: {
                    "_method": 'POST',
                    "_token": token,
                    "id": dataId,
                },
                success:function(data){
                    console.log('success');

                },
                error:function(){

                },
            });




        }


</script>




<script>
    $( function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    } );
</script>

</body>
</html>
