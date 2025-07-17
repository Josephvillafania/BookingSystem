<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl tracking-widest glowing-title">
            🔔 My Notifications
        </h2>
    </x-slot>

    <div class="notifications-container">
        @if(session('success'))
            <div class="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('notifications.clear') }}" class="text-center mb-6">
            @csrf
            <button type="submit" class="btn-clear">🧹 Clear All</button>
        </form>

        @forelse ($notifications as $notification)
            <div class="notif-card">
                <div class="notif-header">
                    <h3>{{ $notification->data['title'] }}</h3>
                    <p class="notif-date">📅 {{ $notification->data['booking_date'] }}</p>
                </div>
                <p class="notif-notes">📝 {{ $notification->data['notes'] }}</p>

                <div class="notif-actions">
                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                        @csrf
                        <button class="btn-action">✔ Mark as Read</button>
                    </form>

                    <form method="POST" action="{{ route('notifications.delete', $notification->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-action btn-delete">🗑 Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="no-notif">📭 You have no notifications.</p>
        @endforelse
    </div>

    <style>
        body {
            background: linear-gradient(135deg, #1e1e2f, #3b3b55); /* Deep space gradient */
            font-family: 'Roboto', sans-serif;
            color: #e0eaff;
            margin: 0;
            padding: 0;
        }

        .glowing-title {
            color: #ff80ff;
            text-shadow: 0 0 12px #ff00ff, 0 0 25px #ff80ff;
            text-align: center;
            margin: 3rem 0;
            font-size: 2.2rem;
        }

        .notifications-container {
            max-width: 900px;
            margin: auto;
            padding: 2rem;
            color: #ffffff;
        }

        .success-alert {
            background: #34d399; /* Success Green */
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            text-align: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 0 15px rgba(52, 211, 153, 0.7);
        }

        .btn-clear {
            background: linear-gradient(90deg, #4f46e5, #9333ea); /* Gradient for clear all */
            color: white;
            padding: 0.7rem 1.6rem;
            font-weight: 600;
            border-radius: 0.8rem;
            border: none;
            box-shadow: 0 0 15px rgba(148, 51, 234, 0.5);
            transition: 0.3s ease-in-out;
        }

        .btn-clear:hover {
            background: linear-gradient(90deg, #9333ea, #4f46e5);
            box-shadow: 0 0 25px rgba(148, 51, 234, 0.8);
            transform: scale(1.05);
        }

        .notif-card {
            background: rgba(255, 255, 255, 0.1); /* Transparent background */
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1.2rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .notif-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 35px rgba(0, 255, 255, 0.3);
        }

        .notif-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .notif-date {
            color: #93c5fd;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .notif-notes {
            color: #cbd5e1;
            font-size: 1.1rem;
            margin: 1rem 0;
        }

        .notif-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn-action {
            background-color: rgba(255, 255, 255, 0.05);
            color: #38bdf8;
            padding: 0.6rem 1.4rem;
            border-radius: 0.6rem;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all 0.3s ease-in-out;
        }

        .btn-action:hover {
            border-color: #38bdf8;
            background-color: rgba(56, 189, 248, 0.2);
            transform: scale(1.05);
        }

        .btn-delete {
            color: #f87171;
        }

        .btn-delete:hover {
            border-color: #f87171;
            background-color: rgba(248, 113, 113, 0.1);
            transform: scale(1.05);
        }

        .no-notif {
            color: #94a3b8;
            text-align: center;
            margin-top: 3rem;
            font-size: 1.3rem;
        }
    </style>
</x-app-layout>
