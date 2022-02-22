<div class="modal fade" id="add_post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dodaj nowy post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="post_title" class="form-text">Tytuł posta</label>
                    <input type="text" id="post_title" name="post_title" class="form-control @error('post_title') is-invalid @enderror" value="{{old('post_title')}}">
                    @error('post_title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="post_content" class="form-text">Zawartość</label>
                    <textarea class="form-control @error('post_content') is-invalid @enderror"  id="post_content" name="post_content" rows="4" style="resize: none;"></textarea>
                    @error('post_content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
      </div>
    </div>
    {{-- @if($errors->has('title') || $errors->has(''))
    {{dd($errors)}}
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#add_post').modal('show');
            });
        </script>
    @endif --}}
</div>
