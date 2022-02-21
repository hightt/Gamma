
<div class="content">
    <nav class="left-nav nav flex-column">
        <a class="nav-link mb-2" href="{{asset("/posts")}}">
            <i class="fas fa-home me-2"></i>
            <span>Strona główna</span>
        </a>
        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-star me-2" style="color: #FFEA00;"></i>
            <span>Ulubione</span>
        </a>
        <a class="nav-link mb-2 {{Auth::check() ? '' : 'disabled'}}" href="{{asset('my-topics')}}">
            <i class="fas fa-plus-square me-2"></i>
            <span>Moje tematy</span>
        </a>
        <a class="nav-link border-0 {{Auth::check() ? '' : 'disabled'}}" href="{{asset('my-answers')}}">
            <i class="fas fa-question me-2"></i>
            <span>Moje odpowiedzi</span>
        </a>
    </nav>
</div>
