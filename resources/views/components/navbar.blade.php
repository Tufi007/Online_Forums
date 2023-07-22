<!-- navbar.blade.php -->
<nav>
    <!-- Your navbar code goes here -->

    <ul class="navbar-container">
        <!-- Other menu items -->

        @guest
        <!-- Show login and signup buttons when the user is not logged in -->
        <li class="nav-item"> <a href="{{ route('home') }}">Home </a> </li>
        <li class="nav-item"><a href="{{ route('global_questions') }}">Questions</a></li>
        <li class="nav-item"><a href="{{ route('login') }}">Login</a></li>
        <li class="nav-item"><a href="{{ route('signup') }}">Signup</a></li>
        <button type="checkbox" id="mobile-menu-btn" class="hidden-btn" onclick="navToggleGuest(this.id)" style="align-self: end;">
            <i class="fa-solid fa-bars"></i>
        </button>
        @else
        <!-- Show a logout button when the user is logged in -->
        <li class="nav-item"> <a href="{{ route('home') }}">Home</a> </li>
        <li class="nav-item"><a href="{{ route('global_questions') }}">Questions</a></li>
        <li class="nav-item"><span>Welcome, {{ Auth::user()->name }}</span></li>
        <li class="nav-item" id="nav-profile">
            <a href="{{ route('my_profile') }}">My Profile</a>
            @if(isset(Auth::user()->profiles))
            <div class="profile-picture-container">
                <img class="profile-picture" src="{{ asset(Auth::user()->profiles->profile_picture) }}" alt="Profile Picture">
            </div>
            @endif
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
        <button type="checkbox" id="mobile-menu-btn" class="hidden-btn" onclick="navToggleAuth(this.id)" style="align-self: end;">
            <i class="fa-solid fa-bars"></i>
        </button>
        @endguest
    </ul>
</nav>
