<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('homePage') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Home
                </a>
                <a class="nav-link" href="{{ route('news_page.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Dashboard Home
                </a>
                @if(auth()->user()->isAdmin())
                <a class="nav-link" href="{{ route('news_page.create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                    Create Post
                </a>
                @endif
                @if(auth()->user()->isAdmin())
                <a class="nav-link" href="{{ route('news_category.create') }}">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-square-plus"></i></div>
                    Create Category
                </a>
                @endif
                @if(auth()->user()->isAdmin())
                <a class="nav-link" href="{{route('manage.users')}}">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-square-plus"></i></div>
                    Manage User
                </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
        
    </nav>
</div>
