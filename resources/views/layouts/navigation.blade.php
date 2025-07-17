<nav x-data="{ open: false }" class="relative z-50">
    <style>
        nav {
            background: linear-gradient(-45deg, #195bb1ff, #08318aff);
            background-size: 400% 400%;
            animation: gradientShift 10s ease infinite;
            border-bottom: 3px solid transparent;
            position: relative;
        }

        nav::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #04e4d9ff, #09f0dcff);
            z-index: 10;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fef2f2;
        }

        .nav-left,
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .nav-logo svg {
            height: 36px;
            fill: #fff;
        }

        .nav-link {
            color: #fff1f2;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
            padding: 0.4rem 0.6rem;
            transition: 0.3s ease;
        }

        .nav-link:hover {
            color: #fda4af;
        }

        .nav-link:hover::before {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #06eafaff, #0dc9ebff);
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 1.6rem;
        }

        .mobile-menu {
            display: none;
        }

        @media (max-width: 768px) {
            .nav-left > .nav-link,
            .nav-right {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .mobile-menu[x-show="open"] {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                background: #e11150ff;
                padding: 1rem 2rem;
                animation: fadeIn 0.4s ease;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-link span {
            display: inline-block;
            position: relative;
        }
    </style>

    @php
        $unreadCount = Auth::user()->unreadNotifications->count();
    @endphp

    <!-- Top Nav -->
    <div class="nav-container">
        <!-- Left -->
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="nav-logo">
                <x-application-logo />
            </a>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        </div>

        <!-- Right -->
        <div class="nav-right">
            <span class="nav-link">👱🏻‍♀️ {{ Auth::user()->name }}</span>

            <a href="{{ route('notifications') }}" class="nav-link relative">
                            🔔 Notifications 
                @if ($unreadCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   class="nav-link"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>

        <!-- Mobile Toggle -->
        <button @click="open = !open" class="hamburger">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="mobile-menu">
        <span class="nav-link">🌼 {{ Auth::user()->name }}</span>

        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

        <a href="{{ route('notifications') }}" class="nav-link relative">
            🔔 Notifications
            @if ($unreadCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </div>
</nav>
