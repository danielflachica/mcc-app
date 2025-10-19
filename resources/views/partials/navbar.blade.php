<nav class="navbar navbar-expand-lg bg-light border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
            <img src="{{ asset('img/mindcare_logo2.png') }}" height="50" class="ml-1"
                alt="{{ config('app.name', 'Mindcare Club') }}">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                @if (auth()->user()->role->name == "Admin")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Users</a>
                </li>
                @elseif (auth()->user()->role->name == "Provider")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('provider.schedule.index') }}">Schedules</a>
                </li>
                @elseif(auth()->user()->role->name == "Client")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.appointment.index') }}">Appointments</a>
                </li>
                @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item d-flex align-items-center">
                    <div class="navbar-text me-3 text-light">
                        Hello, <strong>{{ auth()->user()->name }}</strong>!
                    </div>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                </li>
                @else
                <li class="nav-item me-2">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>