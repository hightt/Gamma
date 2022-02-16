<div class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Zaloguj się</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="email" type="email" value="admin@o2.pl" placeholder="Wprowadz adres e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="password" type="password" value="admin" placeholder="Wprowadz hasło" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 text-start">
                        <button id="register-button" type="button" class="btn btn-success ps-3 pe-3 me-md-3 me-lg-0">
                            <span>Zarejestruj się</span>
                        </button>
                    </div>
                    <div class="col-lg-8 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary">Zaloguj się</button>

                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@if ($errors->any())
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#login').modal('show');
        });
    </script>
@endif

<script>

    $("#register-button").click(function() {
    $("#login").modal('hide');
    $("#register").modal('show');
});
</script>
