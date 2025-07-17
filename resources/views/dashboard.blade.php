<x-app-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f8cdda, #1e3c72); /* Sunset-inspired gradient */
            font-family: 'Arial', sans-serif;
            color: #ffffff;
            box-sizing: border-box;
        }

        .dashboard-container {
            min-height: 100vh;
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .dashboard-header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .dashboard-header p {
            color: #f8e8e1;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.2); /* Soft background for cards */
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(255, 204, 0, 0.3); /* Subtle golden shadow */
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(255, 204, 0, 0.4);
            background-color: rgba(255, 255, 255, 0.4); /* Lighter card background on hover */
        }

        .card h2 {
            font-size: 1.7rem;
            margin-bottom: 0.7rem;
            color: #ffffff;
        }

        .card p {
            font-size: 1.1rem;
            color: #f8e8e1;
        }

        /* Sidebar Toggle Button */
        .drawer-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: #ff5e62; /* Sunset-inspired button color */
            color: white;
            padding: 0.8rem 1.4rem;
            border-radius: 1rem;
            cursor: pointer;
            font-size: 1.8rem;
            z-index: 101;
            box-shadow: 0 0 15px rgba(255, 204, 0, 0.4);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .drawer-toggle:hover {
            background: #ff416c; /* Slightly darker shade on hover */
            transform: scale(1.05);
        }

        /* Sidebar */
        .drawer {
            position: fixed;
            top: 0;
            left: -260px;
            width: 240px;
            height: 100%;
            background: rgba(0, 60, 80, 0.85);
            border-right: 2px solid #ff5e62;
            transition: left 0.3s ease;
            z-index: 100;
            padding: 2rem 1.5rem;
        }

        .drawer.open {
            left: 0;
        }

        .drawer-links {
            margin-top: 3rem;
            display: flex;
            flex-direction: column;
        }

        .drawer a {
            margin-bottom: 1.5rem;
            color: #ffffff;
            background: linear-gradient(to right, #ff5e62, #d4418e); /* Sunset gradient */
            padding: 0.9rem 1.3rem;
            border-radius: 1rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .drawer a:hover {
            background: linear-gradient(to right, #ff416c, #d4418e);
            transform: scale(1.05);
        }

        /* Mobile responsiveness */
        @media (max-width: 640px) {
            .drawer-toggle {
                font-size: 1.4rem;
                padding: 0.6rem 1rem;
            }

            .dashboard-header h1 {
                font-size: 2.3rem;
            }

            .card-grid {
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            }
        }
    </style>

    <!-- Toggle Button -->
    <div class="drawer-toggle" onclick="document.querySelector('.drawer').classList.toggle('open')">☰</div>

    <!-- Sidebar Navigation -->
    <div class="drawer">
        <div class="drawer-links">
            <a href="{{ url('/bookings/create') }}">➕ Create Booking</a>
            <a href="{{ url('/bookings') }}">📖 View Bookings</a>
            <a href="{{ url('/profile') }}">👥 User Management</a>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Booking Dashboard</h1>
            <p>Welcome back bookings! Here’s a quick view of your platform.</p>
        </header>

        <section class="card-grid">
            <div class="card">
                <h2>📊 Total Bookings</h2>
                <p>You currently have <strong>{{ $totalBookings }}</strong> booking{{ $totalBookings !== 1 ? 's' : '' }}.</p>
            </div>

            <div class="card">
                <h2>👥 Total Users</h2>
                <p>There {{ $totalUsers === 1 ? 'is' : 'are' }} <strong>{{ $totalUsers }}</strong> registered user{{ $totalUsers !== 1 ? 's' : '' }}.</p>
            </div>
        </section>
    </div>

    <!-- Click Outside to Close Drawer -->
    <script>
        window.addEventListener('click', function (e) {
            const drawer = document.querySelector('.drawer');
            const toggle = document.querySelector('.drawer-toggle');
            if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
                drawer.classList.remove('open');
            }
        });
    </script>
</x-app-layout>
