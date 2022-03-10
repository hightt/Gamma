@extends('layouts.layout')
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
        <h5 class="text-muted p-0">Dodaj nowy komentarz</h5>
        <form class="p-0 m-0" action="{{route('comments.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" placeholder="Treść komentarza" name="content" rows="4" style="resize: none;"></textarea>
                @error('content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                @error('user_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="text-end mt-3">
                    <input type="submit" value="Dodaj komentarz" class="btn btn-secondary">
                </div>
            </div>
        </form>
    </div>

    <div class="row">
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
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {!! $comments->links() !!}
    </div>
@endsection
