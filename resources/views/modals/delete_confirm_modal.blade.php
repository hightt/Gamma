<div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border: 0;"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Czy na pewno chcesz usunąć wybrany post?</h4>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-success me-2" data-bs-dismiss="modal" style="min-width: 175px;">Zamknij</button>
                            <button id="delete-confirm" class="btn btn-danger ms-2" post_id="" style="min-width: 175px;">Usuń</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: 0;"></div>
        </div>
    </div>
</div>

<script>

$('#delete-confirm').click(function (e) {
    $.ajax({
        type: "POST",
        url: '{{route("posts-ajax.destroy")}}',
        data: {
            _method: 'DELETE',
            post_id: $(this).attr('post_id'),
        },
        success:function(response){
            $('#delete_confirm').modal('toggle');
            showMessage('alert-success', response.success);
            getPosts(page);
        },
        error: function(response){
            showMessage('alert-danger', response.success);
            getPosts(page);
        },
    })
});

</script>
