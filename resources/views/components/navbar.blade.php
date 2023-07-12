
<!-- navbar.blade.php -->
<nav>
    <!-- Your navbar code goes here -->

    <ul>
        <!-- Other menu items -->

        @guest
            <!-- Show login and signup buttons when the user is not logged in -->
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('signup') }}">Signup</a></li>
        @else
            <!-- Show a logout button when the user is logged in -->
            <span>Welcome, {{ Auth::user()->name }}</span>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endguest
    </ul>
</nav>

