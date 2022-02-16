<div class="modal fade" id="add_post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dodaj nowy post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tytuł..." id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="content" name="content" placeholder="Treść posta..." rows="4" style="resize: none;"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" id="submit-form" class="btn btn-primary">Dodaj</button>
        </div>
      </div>
    </div>
  </div>
<script>
    $("#submit-form").click(function(e){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        e.stopImmediatePropagation();
        e.preventDefault();
        var formData = {
            title: $("#title").val(),
            content: $("#content").val(),
        };
            $.ajax({
            type: "POST",
            url: '{{route("posts.store")}}',
            data: formData,
            success:function(response){
                $('#add_post').modal('hide');
                location.reload();
            },
            error: function(response) {
                showMessage('alert-danger', response.responseJSON.message);
            },
        })
    });
</script>
