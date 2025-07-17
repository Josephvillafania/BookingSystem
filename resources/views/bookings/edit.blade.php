<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Booking
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298); /* Space-like gradient background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f1f5f9;
        }

        .form-container {
            max-width: 720px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1); /* Semi-transparent card */
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            color: #f1f5f9;
        }

        .form-container h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #f8fafc;
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.7);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #e2e8f0;
        }

        input[type="text"],
        textarea,
        .flatpickr-input {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #2d3748;
            border-radius: 0.5rem;
            background-color: rgba(255, 255, 255, 0.2); /* Slightly transparent input fields */
            margin-bottom: 1rem;
            color: #f1f5f9;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #00bcd4;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .calendar-wrapper {
            margin-bottom: 1.5rem;
        }

        /* Cosmic Glowing Button */
        .submit-button {
            background: linear-gradient(145deg, #ff6ec7, #ff9a8b); /* Neon gradient effect */
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2), transparent);
            animation: pulse 1.5s infinite;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .submit-button:hover {
            background: linear-gradient(145deg, #3b82f6, #2563eb);
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4), 0 0 60px rgba(0, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .submit-button:active {
            background-color: #2d79a5;
        }

        @keyframes pulse {
            0% {
                transform: scale(0);
                opacity: 0.6;
            }
            50% {
                transform: scale(1);
                opacity: 0.2;
            }
            100% {
                transform: scale(0);
                opacity: 0.6;
            }
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #00bcd4;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #3b82f6;
        }

        .error-box {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .flatpickr-calendar {
            font-size: 1.1rem !important;
        }

        .flatpickr-day {
            padding: 10px !important;
            font-size: 1rem !important;
        }

        .flatpickr-day.selected {
            background-color: #2563eb !important;
            color: white !important;
        }
    </style>

    <div class="form-container">
        <h1>✏️ Edit Booking</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <label for="title">Booking Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $booking->title) }}" required>

            <!-- Booking Date -->
            <label for="booking_date">Booking Date & Time</label>
            <input type="hidden" name="booking_date" id="booking_date"
                value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i')) }}">
            <div id="calendarBox" class="calendar-wrapper"></div>

            <!-- Notes -->
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" rows="4" placeholder="Optional notes...">{{ old('notes', $booking->notes) }}</textarea>

            <!-- Submit -->
            <button type="submit" class="submit-button">✅ Update Booking</button>
        </form>

        <a href="{{ route('bookings.index') }}" class="back-link">← Back to Bookings</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#calendarBox", {
            inline: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: "{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i')) }}",
            time_24hr: false,
            minuteIncrement: 1,
            onChange: function(selectedDates, dateStr) {
                document.getElementById("booking_date").value = dateStr;
            }
        });
    </script>
</x-app-layout>
