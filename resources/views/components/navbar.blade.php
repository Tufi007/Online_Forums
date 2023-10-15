<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex justify-content-between align-items-center"> <!-- Use d-flex, justify-content-between, and align-items-center -->
        <div style="margin-left: 100px"> <!-- Add margin to the left of the brand text -->
            <a class="navbar-brand" href="#">Xpert-Advice</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('signup') }}">Signup</a>
                </li>
                @else
                <li class="nav-item"><span class="nav-link">Welcome, {{ Auth::user()->name }}</span></li>
                <li class="nav-item" id="nav-profile">
                    @if(isset(Auth::user()->profiles))
                    <div class="profile-picture-container">
                        <img class="profile-picture" width="5%" src="{{ asset(Auth::user()->profiles->profile_picture) }}" alt="Profile Picture">
                    </div>
                    @endif
                    <a class="nav-link" href="{{ route('my_profile') }}">My Account</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </li>
                @endguest
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Questions
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('ask_form') }}">Ask Question</a></li>
                        <li><a class="dropdown-item" href="{{ route('global_questions') }}">Global Questions</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
