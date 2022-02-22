@extends('layout')
@section('content')
    @if($posts->isEmpty())
        <h3 class="mt-5 text-center">Brak dostępnych postów</h3>
    @else
        @foreach($posts as $post)
            <div class="post" style="padding-top: 15px !important;">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <form action="{{route('posts.destroy', $post->id)}}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="fav-btn btn bg-warning text-white p-1 ps-2 pe-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Dodaj do ulubionych">
                                <i class="fa-solid fa-star "></i>
                            </button>
                        </form>
                        @if(Auth::check() && Auth::user()->permissions == '1')
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST" class="d-inline-block ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fav-btn btn bg-danger text-white p-1 ps-2 pe-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Usuń post">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
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
