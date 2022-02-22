@extends('layout')
@section('content')

@foreach ($posts as $post)

    <div class="post comment">
        <a href="{{route('posts.show', $post->id)}}">
            <div class="row target-post mb-4">
                <div class="col-12 fw-bold">{{$post->title}}</div>
                <div class="col-12">
                    <div class="text-muted d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$post->content}}">
                        {{substr($post->content, 0, 128)}}
                        <span class="fw-bold">{{strlen($post->content) > 128 ? "... (Czytaj dalej)" : ''}}</span>
                    </div>
                </div>
            </div>
        </a>
        <?php $comments1 = $post->userCommentsBelongsToPost()->get(); ?>
        @foreach ($comments1 as $comment)
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
                                    <ul class="dropdown-menu">
                                        <form action="{{route('comments.destroy', $comment->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Usuń komentarz" class="dropdown-item">
                                        </form>
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
        @endforeach
    </div>
@endforeach

@endsection
