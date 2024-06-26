<nav>
    <div class="nav-wrapper">
        <a href="/">
            <div class="nav-link">
                <p class="{{ request()->routeIs('/') ? 'nav-link-selected' : '' }}">Home</p>
            </div>
        </a>
        <a href="reservations">
            <div class="nav-link">
                <p class="nav-link-user {{ request()->routeIs('reservations') ? 'nav-link-selected' : '' }}">
                <img alt="" class="nav-link-img {{ request()->routeIs('reservations') ? 'user-icon-selected' : 'user-icon-noselected' }}">
                Reservations
            </p>
            </div>
        </a>

        <a href="rooms">
            <div class="nav-link">
                <p class="nav-link-user {{ request()->routeIs(['rooms', 'add-room', 'room-store']) ? 'nav-link-selected' : '' }}">
                <img alt="" class="nav-link-img {{ request()->routeIs(['rooms', 'add-room', 'room-store']) ? 'room-icon-selected' : 'room-icon-noselected' }}">
                Rooms
            </p>
            </div>
        </a>
        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="nav-link nav-link-last">
                <button>Log out</button>
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
    </div>
</nav>