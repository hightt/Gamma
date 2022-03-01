@extends('layouts.layout')
@section('content')
    @include('layouts.post_template')

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(".btn-add").hide();
function myTopics(){
    $.ajax({
        url: '{{route('my-topics')}}',
        type: 'GET',
        success: function(response){
            $('#posts-box').empty();
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
                el.find('.btn-delete').attr('user_id', post.user_id);
                el.find('.btn-add').removeClass('btn-not-active');
                var url = '{{ route("posts.show", ":postId") }}';
                el.find('a').attr('href', url.replace(':postId', post.id));
            }
        },
    });
    }

    $('.btn-delete').click(function (e) {
        $.ajax({
            type: "DELETE",
            url: '{{route("posts-ajax.destroy")}}',
            data: {
                user_id: $(this).attr('user_id'),
                post_id: $(this).attr('post_id'),
            },
            success:function(response){
                showMessage('alert-success', response.success);
                myTopics();
            },
            error: function(response){
                showMessage('alert-danger', response.success);
                myTopics();
            },
        })
   });

    myTopics();
    // setInterval(function () {
    //     getFavouritePosts();
    // }, 12500);
</script>
@endsection
