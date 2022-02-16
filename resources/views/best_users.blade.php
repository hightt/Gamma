
<div class="content">
    <h6 class="best-users-title">Najbardziej aktywni użytkownicy</h6>
    <hr>
    <nav class="nav flex-column">
        <a class="nav-link" href="#">
            @for ($i = 0; $i < count($user_comments); $i++)
                <div class="best-user">
                    <div class="row">
                        <div class="col-lg-2 col-3 text-start">
                            <i class="fas fa-user-circle me-2" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-lg-7 col-6 text-center">
                            {{$user_comments[$i]['user_name']}}
                        </div>
                        <div class="col-lg-3 col-3 text-end">
                            <span>{{$user_comments[$i]['num']}}</span>
                            <i class="ms-1 fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
            @endfor
        </a>
    </nav>
</div>
