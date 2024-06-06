<nav>
    <div class="nav-wrapper">
        <a href="/">
            <div class="nav-link">
                <p class="{{ request()->routeIs('/') ? 'nav-link-selected' : '' }}">Home</p>
            </div>
        </a>
        @auth
        <a href="profile">
            <div class="nav-link">
                <p class="nav-link-user {{ request()->routeIs('profile.edit') ? 'nav-link-selected' : '' }}">
                <img alt="" class="nav-link-img {{ request()->routeIs('profile.edit') ? 'user-icon-selected' : 'user-icon-noselected' }}">
                {{ Str::ucfirst(auth()->user()->username) }}
            </p>
            </div>
        </a>
        @endauth
        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="nav-link nav-link-last">
                <button>Logout</button>
            </div>
        </form>
        @endauth
        @guest
        <a href="{{ route('register') }}">
            <div class="nav-link nav-link-last">
                <p class="{{ request()->routeIs('register') ? 'nav-link-selected' : '' }}">Sign Up</p>
            </div>
        </a>
        @endguest
    </div>
</nav>