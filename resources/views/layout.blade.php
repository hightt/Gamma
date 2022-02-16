<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Gamma - forum internetowe</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="alert alert-fixed" id="alertBox" role="alert"></div>
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <nav class="main-navbar pt-3 pb-3">
                <div class="row">
                    <div class="col-lg-4 col-md-12 text-center">
                        <a href="{{asset("/posts")}}">
                            <i class="fas fa-burn nav-icon"></i>
                            <span class="main-navbar-text" style="font-size: 20px;">Gamma</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <form action="/search" method="GET">
                            <div class="input-group mb-3 search-field w-75 mx-auto">
                                <input type="text" name="search_name" class="form-control" value="{{ old('search_name') }}" placeholder="Wyszukaj post">
                                <button class="btn" type="submit" id="button-addon2" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center">
                        @if(Auth::check())
                            <i class="fas fa-user-circle nav-icon me-2"></i>
                            <span class="main-navbar-text" style="font-size: 15px;">{{Auth::user()->name}}</span>
                            <div class="dropdown dropdown-options">
                                <button class="dropdown-toggle user-options" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a href="{{asset('/logout')}}" class="dropdown-item" type="button">Wyloguj się</a></li>
                                </ul>
                            </div>
                        @else
                            <button type="button" class="btn btn-secondary ps-3 pe-3 me-md-3 me-lg-0 new-post" data-bs-toggle="modal" data-bs-target="#login">
                                <span>Zaloguj się</span>
                            </button>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid w-75 mt-3 mb-3">
        <div class="row">
            <div class="col-lg-12 text-end add-button">
                @if(Request::url() === asset("/posts"))
                    <button type="button" class="btn btn-primary ps-3 pe-3 me-md-3 me-lg-0 new-post" data-bs-toggle="modal" data-bs-target="#add_post">
                        <span>Opublikuj nowy post</span>
                        <i class="ms-2 fas fa-plus"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid w-75">
        <div class="row">
            <div class="col-lg-3">
                @include('menu')
            </div>
            <div class="col-lg-6 post-section">
            @yield('content')
            </div>
            <div class="col-lg-3">
                @include('best_users')
            </div>
        </div>
    </div>

    @include('modals.new_post_modal')
    @include('modals.register_modal')
    @include('modals.login_modal')
  </body>
</html>

<script>

    function showMessage(type, text){
        $("#alertBox").addClass(type);
        $("#alertBox").text(text);
        $("#alertBox").show();
        setTimeout(function() {
        $('#alertBox').fadeOut('fast');
        $("#alertBox").removeClass(type);
        }, 3000);
    }
</script>
