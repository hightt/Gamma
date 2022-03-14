<div class="post" id="post-template">
    <div class="row">
        <div class="col-md-12 text-end">
                <button type="submit" class="btn-add btn btn-not-active bg-warning text-white p-1 ps-2 pe-2" checked="" data-bs-toggle="tooltip" data-bs-placement="top" title="Dodaj do ulubionych"
                    post_id="" user_id="">
                    <i class="fa-solid fa-star"></i>
                </button>
            @if(Auth::check() && Auth::user()->permissions == '1')
                <button type="submit" class="btn-delete btn bg-danger text-white p-1 ps-2 pe-2 " post_id="" data-bs-toggle="modal" data-bs-target="#delete_confirm" >
                    <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuń post"></i>
                </button>
            @endif
        </div>
    </div>
    <a class="post-href" href="">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="post-title"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 post-text">
                    <p class="post-content"></p>
                </div>
                <hr>
            </div>
            <div class="row post-footer">
                <div class="col-lg-4 col-md-6">
                    <i class="fa-solid fa-user me-1"></i>
                    <span class="author"></span>
                </div>
                <div class="col-lg-5 col-md-6 text-md-end text-sm-start">
                    <i class="fa-solid fa-calendar me-1"></i>
                    <span class="post-created-at"></span>
                </div>
                <div class="col-lg-3 col-md-12 text-md-end text-sm-start">
                    <i class="far fa-comment me-1"></i>
                    <span class="comment-num"></span>
                </div>
            </div>
        </div>
    </a>
</div>
