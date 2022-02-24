@extends('layout')
@section('content')
    <div id="posts-box"></div>
    <div class="post" id="post-template">
        <div class="row">
            <div class="col-md-12 text-end">
                    <button type="submit" class="fav-btn btn bg-warning text-white p-1 ps-2 pe-2 btn-add" data-bs-toggle="tooltip" data-bs-placement="top" title="Dodaj do ulubionych"
                        post_id="" user_id="">
                        <i class="fa-solid fa-star "></i>
                    </button>
                </form>
                @if(Auth::check() && Auth::user()->permissions == '1')
                        <button type="submit" class="fav-btn btn bg-danger text-white p-1 ps-2 pe-2 btn-delete" post_id="" user_id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuń post">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <a class="post-href" href="">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="post-title">Templatka</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 post-text">
                        <p class="post-content">Kontent</p>
                    </div>
                    <hr>
                </div>

                <div class="row post-footer">
                    <div class="col-lg-4 col-md-6">
                        <i class="fa-solid fa-user"></i>
                        <span class="author"></span>
                    </div>
                    <div class="col-lg-5 col-md-6 text-md-end text-sm-start">
                        <i class="fa-solid fa-calendar"></i>
                        <span class="post-created-at"></span>
                    </div>
                    <div class="col-lg-3 col-md-12 text-md-end text-sm-start">
                        <i class="far fa-comment"></i>
                        <span class="comment-num"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{-- <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div> --}}


<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function getPosts(){
        $.ajax({
            url: '{{route('posts-ajax.index')}}',
            type: 'GET',
            success: function(response){
                $('#posts-box').empty();
                for(i = 0; i < response.posts.length; i++){
                    var post = response.posts[i];
                    var el = $('#post-template').clone(true).appendTo('#posts-box');
                    el.css("display", "block");
                    el.find('.btn-add').attr('post_id', post.id);
                    el.find('.btn-add').attr('user_id', post.user_id);
                    el.find('.btn-delete').attr('post_id', post.id);
                    el.find('.btn-delete').attr('user_id', post.user_id);
                    el.find('.post-title').text(post.title);
                    el.find('.post-content').text(post.content);
                    el.find('.author').text(post.user_name);
                    el.find('.post-created-at').text(post.formatted_created_at);
                    el.find('.comment-num').text(post.comment_num);
                    el.find('.btn-add').attr('post_id', post.id);
                    el.find('.btn-delete').attr('post_id', post.id);
                }
            },
        });
    }

    $('.btn-add').click(function (e) {
        $.ajax({
            type: "POST",
            url: '{{route("favourite-post.store")}}',
            data: {
                user_id: '{{auth()->user() ? auth()->user()->id : ""}}',
                post_id: $(this).attr('post_id'),
            },
            success:function(response){
                $(this).addClass('btn-not-active');
                console.log('dodano');
            },
            error: function(response){
                $(this).removeClass('btn-not-active');
                console.log('nie dziala');
            },
        })
   });

   $('.btn-delete').click(function (e) {
        $.ajax({
            type: "DELETE",
            url: '{{route("posts-ajax.destroy")}}',
            data: {
                user_id: '{{auth()->user() ? auth()->user()->id : ""}}',
                post_id: $(this).attr('post_id'),
            },
            success:function(response){
                $(this).addClass('btn-not-active');
                getPosts();
                console.log('dodano');
            },
            error: function(response){
                $(this).removeClass('btn-not-active');
                getPosts();
                console.log('nie dziala');
            },
        })
   });

    getPosts();
    setInterval(function () {
        getPosts();
    }, 2000);
</script>

@endsection
