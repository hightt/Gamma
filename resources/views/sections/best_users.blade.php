
<div class="content">
    <h6 class="best-users-title text-center">Najbardziej aktywni użytkownicy</h6>
    <hr>
    <nav class="nav flex-column">
        @for ($i = 0; $i < count($best_users); $i++)
            <a class="nav-link pt-0 pb-0" title="{{$best_users[$i]['user_name']}}" style="max-height: 45px;">
                <div class="best-user">
                    <div class="row">
                        <div class="col-2 text-start p-0">
                            <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-6 text-center p-0">
                            <?php $best_user_name = $best_users[$i]['user_name']; ?>
                            @if(strlen($best_user_name) > 17)
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{$best_user_name}}">{{substr($best_user_name, 0, 15)}} ...</span>
                            @else
                                <span>{{$best_user_name}}</span>
                            @endif

                        </div>
                        <div class="col-3 text-end p-0">
                            <span>{{$best_users[$i]['num']}}</span>
                            <i class="ms-1 fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endfor
    </nav>
</div>
