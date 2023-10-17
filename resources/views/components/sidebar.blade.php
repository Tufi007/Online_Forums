<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <button class="btn btn-primary" id="toggle-sidebar">Sidebar</button>
            <div class="sidebar" id="sidebar">
                <ul class="list-group">
                    @auth
                    <li class="list-group-item"><a href="{{ route('ask_form') }}">Ask a Question</a></li>
                    @endauth
                    <li class="list-group-item"><a href="{{ route('global_questions') }}">Global Questions</a></li>
                    <li class="list-group-item"><a href="{{ route('showSearchUsers') }}">Search Users</a>
                    </li>
                    <li class="list-group-item"><a href="{{ route('showSearch.questions') }}">Search Questions</a></li>
                    @if (Auth::check() && Auth::user()->admin)
                    @if (Auth::user()->admin->is_admin === 1)
                    <li class="list-group-item"><a href="{{ route('subject-page') }}">Subjects</a></li>
                    @endif
                    @endif
                    <li class="list-group-item"> <a href="{{ route('notifications.index') }}">View Notifications</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
