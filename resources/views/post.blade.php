@extends('layout')
@section('content')
    <div class="post" style="cursor: unset;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="post-title">{{$post->title}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 post-text">
                        <p>{{$post->content}}</p>
                    </div>
                    <hr>
                </div>
                <div class="row post-footer">
                    <div class="col-lg-6 col-md-6">
                        <span>Opublikowane przez {{$post->user()->name}}</span>
                    </div>
                    <div class="col-lg-6 col-md-12 text-end">
                        <p>{{$post->created_at->format('Y-m-d H:i:s')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row post ms-0 me-0" style="cursor: unset;">
        <form class="p-0 m-0">
            <div class="mb-3">
                <textarea id="comment_content" class="form-control" placeholder="Treść komentarza..." rows="4" style="resize: none;"></textarea>
            </div>
            <button id="add-comment" type="submit" class="btn btn-primary">
                Dodaj nowy komentarz
                <i class="ms-2 fas fa-plus"></i>
            </button>
        </form>
    </div>

    <div class="row" style="min-height: 525px;">
        <div class="col-12">
            @foreach ($comments as $comment)
                <div class="post comment">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <i class="fas fa-user-circle me-2" style="font-size: 35px;"></i>
                                    <span class="main-navbar-text">{{$comment->author_name}}</span>
                                </div>
                                @if(Auth::check() && Auth::user()->permissions == '1')
                                    <div class="col-lg-4 col-4 text-end">
                                        <span class="main-navbar-text post-footer" style="bottom: -10px;">
                                        {{$comment->created_at->format('Y-m-d H:i:s')}}
                                        </span>
                                    </div>
                                    <div class="col-md-2 col-2 text-end">
                                        <div class="dropdown dropdown-options">
                                            <button class="user-options comment-options" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical" style="font-size: 20px;"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <li><a class="dropdown-item delete-comment" comment_id="{{$comment->id}}" id="delete-submit">Usuń komentarz</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 col-6 text-end">
                                        <span class="main-navbar-text post-footer" style="bottom: -10px;">
                                        {{$comment->created_at->format('Y-m-d H:i')}}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-3 post-text">
                                    <p>{{$comment->content}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {!! $comments->links() !!}
    </div>

    <script>
        $("#add-comment").click(function(e){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            e.stopImmediatePropagation();
            e.preventDefault();
            var formData = {
                post_id: '{{$post->id}}',
                content: $("#comment_content").val(),
            };
                $.ajax({
                type: "POST",
                url: '{{route("comments.store")}}',
                data: formData,
                success:function(response){
                    location.reload();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(i, error){
                        showMessage('alert-danger', error.toString());
                    });
                },
            })
        });

         $('.delete-comment').click(function (e) {
            var commentId = $(this).attr("comment_id");
            var url = '{{ route("comments.destroy", ":commentId") }}';
            url = url.replace(':commentId', commentId);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            e.preventDefault();
            var data = {
                comment_id: commentId,
            };
            $.ajax({
                type: "DELETE",
                url: url,
                data: data,
                success:function(response){
                    showMessage('alert-success', 'Pomyślnie usunięto komentarz.');
                    setInterval(function () { location.reload(); }, 1000);
                },
                error: function(response){
                    showMessage('alert-danger', 'Błąd systemu.');
                },
            })
        });

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

@endsection
