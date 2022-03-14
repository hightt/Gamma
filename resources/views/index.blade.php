@extends('layouts.layout')
@section('content')
    <section id="posts-box">
        @include('layouts.post_template')
    </section>

    <nav aria-label="Page navigation example">
        <div class="text-center">
            <ul class="pagination justify-content-center pg-posts">
                <li class="page-item"><a class="page-link" id="previous-page">Poprzednia</a></li>
                <li class="page-item"><a class="page-link" id="next-page" last_page="" >Następna</a></li>
              </ul>
        </div>
    </nav>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var page = 1;
    function getPosts(page) {
        $.ajax({
            url: '/posts-ajax?page=' + page,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                $('#posts-box').empty();
                if(response.posts.data.length > 0) {
                    for(i = 0; i < response.posts.data.length; i++){
                        var post = response.posts.data[i];
                        var el = $('#post-template').clone(true).appendTo('#posts-box');
                        el.css("display", "block");
                        el.removeAttr('id');
                        el.find('.post-title').text(post.title);
                        el.find('.post-content').text(post.content);
                        el.find('.author').text(post.user.name);
                        el.find('.post-created-at').text(post.formatted_created_at);
                        el.find('.comment-num').text(post.comment_num);
                        el.find('.btn-add').attr('post_id', post.id);
                        el.find('.btn-add').attr('user_id', post.user_id);
                        el.find('.btn-delete').attr('post_id', post.id);
                        el.find('.btn-delete').attr('user_id', el.find('.btn-add').attr('user_id'));
                        var url = '{{ route("posts.show", ":postId") }}';
                        el.find('a').attr('href', url.replace(':postId', post.id));
                    }
                } else {
                    $("#next-page").hide();
                    $("#previous-page").hide();
                    $("#posts-box").html('<h3 class="text-center">Brak postów do wyświetlenia</h3>');
                }

            },
            complete: function(response) {
                if($.isNumeric(response.responseJSON.favouritePosts.length)) {
                    var getPostsId = response.responseJSON.posts.data.map(function(post) { return post.id; });
                    var favouritePosts = response.responseJSON.favouritePosts.map(function(favPost) { return favPost.post_id; });
                    getFavouritePosts(getPostsId,  favouritePosts);
                }
                $("#next-page").attr("last_page", response.responseJSON.posts.last_page);
                disableButtonCheck(page, response.responseJSON.posts.last_page);
            }
        });
    }

    function disableButtonCheck(current_page, last_page) {
        if(current_page == last_page) {
            $("#next-page").addClass("disabled").css('cursor', 'default');
        } else {
            $("#next-page").removeClass("disabled").css('cursor', 'pointer');
        }
        if(current_page < 2) {
            $("#previous-page").addClass("disabled").css('cursor', 'default');
        } else {
            $("#previous-page").removeClass("disabled").css('cursor', 'pointer');
        }
    }

    $("#search_name").on("input", function() {
        var value = $(this).val().toLowerCase();
        $("#posts-box .post").each(function() {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });

    function scrollTop() {
        $('html, body').animate({
            scrollTop: $('html, body').offset().top,
        });
    }

    $('#next-page').click(function (e) {
        getPosts(++page);
        scrollTop();
    });

    $('#previous-page').click(function (e) {
        getPosts(--page);
        scrollTop();
    });

    function getFavouritePosts(postsId, favouritePosts) {
        $.each(postsId, function(index, value) {
            if($.inArray(value, favouritePosts) != -1) {
                $('.btn-add[post_id=' + value + ']').removeClass('btn-not-active')
            }
        });
    }

    $('.btn-add').click(function (e) {
        $.ajax({
            type: "POST",
            url: '{{route("favourite-posts.store")}}',
            data: {
                user_id: '{{auth()->user() ? auth()->user()->id : ""}}',
                post_id: $(this).attr('post_id'),
            },
            success:function(response){
                showMessage('alert-success', response.success);
                getPosts(page);
            },
            error: function(response){
                $.each(response.responseJSON.errors, function(key,value) {
                    showMessage('alert-danger', value);
                });

                getPosts(page);
            },
        })
   });

    $('.btn-delete').click(function (e) {
        console.log($(this).attr('post_id'));
        $('#delete-confirm').attr('post_id', $(this).attr('post_id'));
    });


    getPosts(page);
    // setInterval(function () {
    //     getPosts();
    // }, 2500);
</script>
@include('modals.delete_confirm_modal')
@include('modals.new_post_modal')
@endsection
