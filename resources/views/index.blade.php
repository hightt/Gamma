@extends('layout')
@section('content')
    @if($posts->isEmpty())
        <h3 class="mt-5 text-center">Brak dostępnych postów</h3>
    @else
        @foreach($posts as $post)
            <div class="post" onclick="location.href='{{asset('posts/'. $post->id)}}}}';" tabindex="1">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(Auth::check() && Auth::user()->permissions == '1')
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="post-title">{{$post->title}}</h4>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <div class="dropdown dropdown-options">
                                                <button class="user-options post-options" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical" style="font-size: 20px;"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li><a class="dropdown-item delete-submit" post_id="{{$post->id}}" id="delete-submit">Usuń post</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="post-title">{{$post->title}}</h4>
                                        </div>
                                    </div>
                                @endif
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
                                {{-- <i class="fas fa-user-circle me-2"></i> --}}
                                <span>Opublikowane przez  {{$post->user()->name}}</span>
                            </div>
                            <div class="col-lg-3 col-md-6 text-end">
                                <span>@if($post->created_at != null) {{$post->created_at->format('Y-m-d H:i')}}@endif</span>
                            </div>
                            <div class="col-lg-3 col-md-12 text-end">
                                <i class="far fa-comment"></i>
                                <span>{{$post->comments()->count()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endif

    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
    <script>
        $('.post-options').click(function() {return false; });
        $('.delete-submit').click(function() {return false; });

         $('.delete-submit').click(function (e) {
            var postId = $(this).attr("post_id");
            var url = '{{ route("posts.destroy", ":postId") }}';
            url = url.replace(':postId', postId);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            e.preventDefault();
            // e.stopImmediatePropagation();
            var data = {
                post_id: postId,
            };
            $.ajax({
                type: "DELETE",
                url: url,
                data: data,
                success:function(response){
                    showMessage('alert-success', 'Pomyślnie usunięto post.');
                    setInterval(function () { location.reload(); }, 1000);
                },
                error: function(response){
                    showMessage('alert-danger', 'Błąd systemu.');
                },
            })
        });
    </script>
@endsection
