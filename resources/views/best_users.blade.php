
<div class="content">
    <h6 class="best-users-title text-center">Najbardziej aktywni użytkownicy</h6>
    <hr>
    <nav class="nav flex-column">
        @for ($i = 0; $i < count($user_comments); $i++)
        <a class="nav-link" href="#" title="{{$user_comments[$i]['user_name']}}">
            <div class="best-user">
                <div class="row">
                    <div class="col-xl-2 col-lg-6 col-md-2 text-lg-center text-md-start text-xl-start">
                        <i class="fas fa-user-circle me-2" style="font-size: 30px;"></i>
                    </div>
                    <div class="col-xl-7 col-md-7 d-lg-none d-xl-block text-md-center text-xl-center">
                        {{$user_comments[$i]['user_name']}}
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-3 text-md-end text-lg-end text-xl-end">
                        <span>{{$user_comments[$i]['num']}}</span>
                        <i class="ms-1 fas fa-arrow-up"></i>
                    </div>
                </div>
            </div>
        </a>
        @endfor
    </nav>
</div>
