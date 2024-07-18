<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    {{-- <a class="navbar-brand js-scroll-trigger" href="#page-top"></a> --}}
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('landing.index') }}#about">
                    <div class="bg-nav-wrapper mt-0 mt-lg-4">
                        <div class="bg-nav"></div>
                        <h5>A B O U T &nbsp; U S</h5>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('landing.index') }}#service">
                    <div class="bg-nav-wrapper mt-0 mt-lg-4">
                        <div class="bg-nav"></div>
                        <h5>O U R &nbsp; S E R V I C E</h5>
                    </div>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <a href="{{ route('landing.index') }}">
                    <img class="mt-4" src="{{ asset('storage/' . @$setting->firstWhere('key', 'logo')->value) }}"
                        style="width: auto; height: 75px;" alt="">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('landing.index') }}#team">
                    <div class="bg-nav-wrapper mt-0 mt-lg-4">
                        <div class="bg-nav"></div>
                        <h5>O U R &nbsp; T E A M</h5>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('gallery.photo') }}">
                    <div class="bg-nav-wrapper mt-0 mt-lg-4">
                        <div class="bg-nav"></div>
                        <h5>O U R &nbsp; W O R K S</h5>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>
