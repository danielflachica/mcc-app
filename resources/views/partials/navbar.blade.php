<nav class="navbar navbar-expand-lg navbar-dark bg-primary m-0 fixed-top">
    <div class="container">
        <a class="navbar-brand pt-0 fw-bold text-primary" href="{{ route('home') }}">
            <img src="{{ asset('img/mindcare_logo2.png') }}" height="55" class="ml-1"
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
                    <a class="nav-link {{ request()->route()->getName() == 'admin.index' ? 'active' : '' }}"
                        href="{{ route('home') }}">Users</a>
                </li>
                @elseif (auth()->user()->role->name == "Provider")
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() == 'provider.schedule.index' ? 'active' : '' }}"
                        href="{{ route('provider.schedule.index') }}">Schedules</a>
                </li>
                @elseif(auth()->user()->role->name == "Client")
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() == 'client.appointment.index' ? 'active' : '' }}"
                        href="{{ route('client.appointment.index') }}">Appointments</a>
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
                    <a class="nav-link {{ request()->route()->getName() == 'login' ? 'active' : '' }}"
                        href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() == 'register' ? 'active' : '' }}"
                        href="{{ route('register') }}">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>