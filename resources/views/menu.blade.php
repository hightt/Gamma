
<div class="content">
    <nav class="left-nav nav flex-column main-menu">
        <a class="nav-link mb-2 main-link" href="{{asset("/posts")}}" data-bs-toggle="tooltip" data-bs-placement="left" title="">
            <i class="fas fa-home me-2"></i>
            <span>Strona główna</span>
        </a>
        <a class="nav-link mb-2 main-link" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="">
            <i class="fa-solid fa-star me-2"></i>
            <span>Ulubione</span>
        </a>
        <a class="nav-link mb-2 main-link {{Auth::check() ? '' : 'disabled-link'}}" href="{{asset('my-topics')}}" data-bs-toggle="tooltip" data-bs-placement="left" title="">
            <i class="fas fa-plus-square me-2"></i>
            <span>Moje tematy</span>
        </a>
        <a class="nav-link border-0 main-link {{Auth::check() ? '' : 'disabled-link'}}" href="{{asset('my-answers')}}" data-bs-toggle="tooltip" data-bs-placement="left" title="">
            <i class="fas fa-question me-2"></i>
            <span>Moje odpowiedzi</span>
        </a>
    </nav>
</div>

<script type="text/javascript">
    $('.main-link').each(function(index,item){
        var classStr = $(this).attr('class');
        if(classStr.substr(classStr.lastIndexOf(' ') + 1) == 'disabled-link') {
            $(this).attr('data-bs-original-title', 'Musisz być zalogowany, aby przejść dalej.')
        }

    });
</script>
