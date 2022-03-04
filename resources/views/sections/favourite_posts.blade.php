@extends('layouts.layout')
@section('content')
    <section id="posts-box">
        @include('layouts.post_template')
    </section>

<script>
    $(".btn-delete").hide();
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function getFavouritePosts(){
        $.ajax({
            url: '{{route('favourite-posts.get')}}',
            type: 'GET',
            success: function(response){
                $('#posts-box').empty();
                if(response.posts.length > 0) {
                    for(i = 0; i < response.posts.length; i++){
                        var post = response.posts[i];
                        var el = $('#post-template').clone(true).appendTo('#posts-box');
                        el.css("display", "block");
                        el.find('.post-title').text(post.title);
                        el.find('.post-content').text(post.content);
                        el.find('.author').text(post.user.name);
                        el.find('.post-created-at').text(post.formatted_created_at);
                        el.find('.comment-num').text(post.comment_num);
                        el.find('.btn-add').attr('post_id', post.id);
                        el.find('.btn-add').attr('user_id', post.user_id);
                        el.find('.btn-delete').attr('post_id', post.id);
                        el.find('.btn-add').removeClass('btn-not-active');
                        var url = '{{ route("posts.show", ":postId") }}';
                        el.find('a').attr('href', url.replace(':postId', post.id));
                    }
                } else {
                    $("#posts-box").html('<h3 class="text-center">Brak ulubionych postów do wyświetlenia</h3>');
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
                showMessage('alert-success', response.success);
                getFavouritePosts();
            },
            error: function(response){
                $.each(response.responseJSON.errors, function(key,value) {
                    showMessage('alert-danger', value);
                });
                getFavouritePosts();
            },
        })
   });

    getFavouritePosts();

</script>
@endsection
