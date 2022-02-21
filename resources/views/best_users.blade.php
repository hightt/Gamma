
<div class="content">
    <h6 class="best-users-title text-center">Najbardziej aktywni użytkownicy</h6>
    <hr>
    <nav class="nav flex-column">
        @for ($i = 0; $i < count($best_users); $i++)
        <a class="nav-link pt-0 pb-0" title="{{$best_users[$i]['user_name']}}" style="max-height: 45px;">
            <div class="best-user">
                <div class="row">
                    <div class="col-xl-1 col-lg-6 col-md-2 text-start">
                        {{-- <i class="fas fa-user-circle me-2" style="font-size: 30px;"></i> --}}
                        <span class="fw-bold">{{$i + 1}}.</span>
                    </div>
                    <div class="col-xl-7 col-md-7 d-lg-none d-xl-block text-md-center text-xl-center">
                        <?php $best_user_name = $best_users[$i]['user_name']; ?>
                        @if(strlen($best_user_name) > 15)
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{$best_user_name}}">{{substr($best_user_name, 0, 13)}} ...</span>
                        @else
                            <span>{{$best_user_name}}</span>
                        @endif

                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-3 text-md-end text-lg-end text-xl-end">
                        <span>{{$best_users[$i]['num']}}</span>
                        <i class="ms-1 fas fa-arrow-up"></i>
                    </div>
                </div>
            </div>
        </a>
        @endfor
    </nav>
</div>
