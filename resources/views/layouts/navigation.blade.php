<nav x-data="{ open: false }" class="relative z-50">
    <style>
        /* Base Styles */
        nav {
            background: linear-gradient(135deg, #2c3e50, #34495e); /* Dark gradient for navbar */
            border-bottom: 3px solid transparent;
            position: relative;
            z-index: 20;
        }

        nav::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #ff7b00, #feda3d);
            z-index: 10;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f1f5f9;
        }

        /* Left Section */
        .nav-left,
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-logo svg {
            height: 36px;
            fill: #ffffff;
        }

        /* Navigation Links */
        .nav-link {
            color: #f1f5f9;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
            padding: 0.5rem 0.8rem;
            transition: 0.3s ease;
        }

        .nav-link:hover {
            color: #feda3d;
            transform: scale(1.05);
        }

        .nav-link:hover::before {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #ff7b00, #feda3d);
        }

        /* Hamburger Menu (Mobile) */
        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: #ffffff;
            font-size: 1.8rem;
        }

        .mobile-menu {
            display: none;
            background: #2c3e50;
            padding: 1rem 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: absolute;
            top: 70px;
            left: 0;
            width: 100%;
            z-index: 50;
            transition: transform 0.3s ease-in-out;
            transform: translateY(-100%);
        }

        .mobile-menu[x-show="open"] {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transform: translateY(0);
        }

        /* Mobile View: Hide large menu, show hamburger */
        @media (max-width: 768px) {
            .nav-left > .nav-link,
            .nav-right {
                display: none;
            }

            .hamburger {
                display: block;
            }
        }

        /* Mobile Menu Styling */
        .mobile-menu .nav-link {
            padding: 0.8rem 0;
            font-size: 1.1rem;
            text-align: center;
        }

        .mobile-menu .nav-link:hover {
            color: #feda3d;
            background: #34495e;
            transform: scale(1.05);
        }

        .mobile-menu .nav-link:active {
            background: #ff7b00;
        }

        .nav-link-notification {
            position: relative;
            display: flex;
            align-items: center;
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -4px;
            background-color: #e74c3c;
            color: white;
            font-size: 0.8rem;
            padding: 0.3rem 0.5rem;
            border-radius: 9999px;
        }
    </style>

    @php
        $unreadCount = Auth::user()->unreadNotifications->count();
    @endphp

    <!-- Top Nav -->
    <div class="nav-container">
        <!-- Left Section -->
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="nav-logo">
                <x-application-logo />
            </a>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        </div>

        <!-- Right Section -->
        <div class="nav-right">
            <span class="nav-link">👤 {{ Auth::user()->name }}</span>

            <a href="{{ route('notifications') }}" class="nav-link nav-link-notification">
                🔔 Notifications
                @if ($unreadCount > 0)
                    <span class="notification-badge">{{ $unreadCount }}</span>
                @endif
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   class="nav-link"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </a>
            </form>
        </div>

        <!-- Mobile Toggle Button -->
        <button @click="open = !open" class="hamburger">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="mobile-menu">
        <span class="nav-link">👤 {{ Auth::user()->name }}</span>

        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

        <a href="{{ route('notifications') }}" class="nav-link nav-link-notification">
            🔔 Notifications
            @if ($unreadCount > 0)
                <span class="notification-badge">{{ $unreadCount }}</span>
            @endif
        </a>

        <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); this.closest('form').submit();">
                Log Out
            </a>
        </form>
    </div>
</nav>
