<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">✨ My Elegant Bookings</h2>
    </x-slot>

    <div class="main-container">
        <div class="max-w-6xl mx-auto mt-10 px-6">
            @if (session('success'))
                <div class="alert-success animate-glow">
                    {{ session('success') }}
                </div>
            @endif

            @if ($bookings->isEmpty())
                <div class="no-bookings">
                    <p class="mb-4 text-lg">You have no bookings yet. Click below to get started!</p>
                    <a href="{{ route('bookings.create') }}" class="btn-primary glow-button">+ Create Booking</a>
                </div>
            @else
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y g:i A') }}</td>
                                    <td>{{ $booking->notes ?? '-' }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('bookings.edit', $booking) }}" class="edit-btn">✏️ Edit</a>
                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">🗑️ Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="new-booking">
                <a href="{{ route('bookings.create') }}" class="btn-primary glow-button">+ New Booking</a>
            </div>
        </div>
    </div>

    {{-- 🌈 Styling --}}
    <style>
        body {
            background: linear-gradient(135deg, #232526, #414345); /* Deep gradient for modern dark look */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e0e7ff;
        }

        .main-container {
            background: rgba(18, 18, 27, 0.8); /* Dark translucent background */
            min-height: 100vh;
            padding-bottom: 4rem;
            border-radius: 1.5rem;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.5);
        }

        .page-header {
            font-size: 2.4rem;
            font-weight: 700;
            color: #ff9b00;
            text-shadow: 0 0 20px rgba(255, 155, 0, 0.8);
            margin-bottom: 2rem;
            text-align: center;
            padding-top: 2rem;
        }

        .alert-success {
            background: linear-gradient(120deg, #00c6ff, #0072ff); /* Bright blue gradient */
            color: white;
            padding: 1rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 0 25px rgba(0, 98, 255, 0.6);
            font-weight: bold;
            text-align: center;
        }

        .animate-glow {
            animation: glowPulse 2s infinite;
        }

        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 98, 255, 0.6); }
            50% { box-shadow: 0 0 40px rgba(0, 98, 255, 1); }
        }

        .no-bookings {
            background: #161d2f;
            border: 1px solid #5b84c3;
            padding: 2.5rem;
            border-radius: 1rem;
            text-align: center;
            color: #cfd8dc;
            font-size: 1.1rem;
            box-shadow: 0 0 20px rgba(93, 174, 240, 0.5);
        }

        .table-container {
            overflow-x: auto;
            background-color: #1b2a3d;
            border-radius: 1.5rem;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #00c6ff, #0072ff) 1;
            padding: 1rem;
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #e0e7ff;
            font-size: 1rem;
            text-align: center;
        }

        thead {
            background: linear-gradient(to right, #0072ff, #00c6ff);
            color: white;
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        th, td {
            padding: 1.25rem;
            border-top: 1px solid #2e3b56;
        }

        tr:hover {
            background-color: #3c4f6e;
            box-shadow: 0 0 15px rgba(0, 98, 255, 0.2);
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            margin: 0 0.2rem;
        }

        .edit-btn {
            background: linear-gradient(to right, #29b6f6, #00c6ff);
            color: white;
            box-shadow: 0 0 12px rgba(41, 182, 246, 0.5);
        }

        .edit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(41, 182, 246, 0.8);
        }

        .delete-btn {
            background: linear-gradient(to right, #ff6f61, #e53935);
            color: white;
            box-shadow: 0 0 12px rgba(255, 105, 97, 0.5);
        }

        .delete-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(255, 105, 97, 0.8);
        }

        .new-booking {
            margin-top: 3rem;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(to right, #f9a825, #f57c00);
            color: white;
            padding: 0.75rem 2.2rem;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 0.75rem;
            text-decoration: none;
            display: inline-block;
        }

        .glow-button {
            box-shadow: 0 0 15px rgba(255, 167, 38, 0.6);
            transition: all 0.3s ease;
        }

        .glow-button:hover {
            transform: scale(1.07);
            box-shadow: 0 0 30px rgba(255, 167, 38, 0.8);
        }
    </style>
</x-app-layout>
