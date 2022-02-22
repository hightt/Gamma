@extends('layout')
@section('content')
    @if($posts->isEmpty())
        <h3 class="mt-5 text-center">Brak dostępnych postów</h3>
    @else
        @foreach($posts as $post)
            <div class="post">
                <div class="row">
                    @if(Auth::check() && Auth::user()->permissions == '1')
                        <div class="col-md-12 text-end">
                            <div class="dropdown dropdown-options">
                                <button class="user-options post-options" type="button" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical" style="font-size: 20px;" ></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                       <input type="submit" value="Usuń post" class="dropdown-item">
                                    </form>
                                </ul>

                            </div>
                        </div>
                    @endif
                </div>
                <a href="{{route('posts.show', $post->id)}}">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12">
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
                                <span>Opublikowane przez  {{$post->user()->name}}</span>
                            </div>
                            <div class="col-lg-3 col-md-6 text-md-end text-sm-start">
                                <span>@if($post->created_at != null) {{$post->created_at->format('Y-m-d H:i')}}@endif</span>
                            </div>
                            <div class="col-lg-3 col-md-12 text-md-end text-sm-start">
                                <i class="far fa-comment"></i>
                                <span>{{$post->comments()->count()}}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    @endif

    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
@endsection
