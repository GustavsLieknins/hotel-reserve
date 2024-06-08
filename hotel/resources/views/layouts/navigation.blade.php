<nav>
    <div class="nav-wrapper">
        <a href="/">
            <div class="nav-link">
                <p class="{{ request()->routeIs('/') ? 'nav-link-selected' : '' }}">Home</p>
            </div>
        </a>
        @auth
        <a href="account">
            <div class="nav-link">
                <p class="nav-link-user {{ request()->routeIs('account') ? 'nav-link-selected' : '' }}">
                <img alt="" class="nav-link-img {{ request()->routeIs('account') ? 'user-icon-selected' : 'user-icon-noselected' }}">
                {{ Str::ucfirst(auth()->user()->username) }}
            </p>
            </div>
        </a>
        @endauth
        @auth
        <a href="profile">
            <div class="nav-link">
                <p class="nav-link-user {{ request()->routeIs('profile.edit') ? 'nav-link-selected' : '' }}">
                <img alt="" class="nav-link-img {{ request()->routeIs('profile.edit') ? 'settings-icon-selected' : 'settings-icon-noselected' }}">
                Settings
            </p>
            </div>
        </a>
        @endauth
        @auth
            @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                <a href="{{ route('admin') }}">
                    <div class="nav-link">
                        <p class="nav-link-user {{ request()->routeIs('admin') ? 'nav-link-selected' : '' }}">
                            Admin
                        </p>
                    </div>
                </a>
            @endif
        @endauth
        @auth
            @if(auth()->user()->role == 2 )
                <a href="{{ route('superadmin') }}">
                    <div class="nav-link">
                        <p class="nav-link-user {{ request()->routeIs('superadmin','findUser','roleChange','userDelete') ? 'nav-link-selected' : '' }}">
                            SuperAdmin
                        </p>
                    </div>
                </a>
            @endif
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