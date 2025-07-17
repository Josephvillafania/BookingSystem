<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            background: linear-gradient(145deg, #1f3b4d, #2c5c7f); /* Dark gradient for background */
            font-family: 'Roboto', sans-serif;
            color: #e4e4e7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-wrapper {
            width: 100%;
            max-width: 650px;
            background: rgba(34, 45, 55, 0.9); /* Dark card background */
            padding: 2rem;
            border-radius: 12px;
            border: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .form-title {
            font-size: 2.4rem;
            font-weight: 700;
            color: #ffb400;
            text-align: center;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #f1f5f9;
        }

        input[type="text"],
        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #2c3e50;
            background-color: #34495e;
            color: #f1f5f9;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="datetime-local"]:focus,
        textarea:focus {
            border-color: #ffb400;
            background-color: #3e5f7e;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 180, 0, 0.6);
        }

        .submit-btn {
            background-color: #ffb400;
            color: #fff;
            padding: 0.9rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #ff8c00;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(255, 140, 0, 0.4);
        }

        .error-box {
            background-color: #e74c3c;
            color: #fff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        /* Calendar Styling */
        #calendarBox {
            max-width: 100%;
            margin: 0 auto 2rem auto;
        }

        .flatpickr-calendar {
            font-size: 1.1rem;
            background-color: #34495e !important;
            color: #e4e4e7 !important;
            border-radius: 10px;
        }

        .flatpickr-day {
            padding: 10px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .flatpickr-day.selected {
            background-color: #ffb400 !important;
            color: white !important;
        }

        .flatpickr-day:hover {
            background-color: #2c3e50 !important;
            cursor: pointer;
        }

        .flatpickr-time {
            background-color: #34495e !important;
            border: none;
            color: #f1f5f9 !important;
        }

        .flatpickr-time input {
            color: #f1f5f9 !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-wrapper {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .form-wrapper {
                width: 100%;
                padding: 1.2rem;
            }
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            📅 Create Booking
        </h2>
    </x-slot>

    <div class="center-container">
        <div class="form-wrapper">
            <h1 class="form-title">📅 Create Booking</h1>

            @if ($errors->any())
                <div class="error-box">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <!-- Booking Title -->
                <label for="title">Booking Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Enter the booking title"
                >

                <!-- Booking Calendar -->
                <label for="booking_date">Booking Date & Time</label>
                <input type="hidden" name="booking_date" id="booking_date">
                <div id="calendarBox"></div>

                <!-- Notes -->
                <label for="notes">Notes (Optional)</label>
                <textarea
                    name="notes"
                    id="notes"
                    rows="4"
                    placeholder="Any extra information...">{{ old('notes') }}</textarea>

                <!-- Submit -->
                <button type="submit" class="submit-btn">➕ Submit Booking</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#calendarBox", {
            inline: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: new Date(),
            time_24hr: false,
            minuteIncrement: 1,
            onChange: function(selectedDates, dateStr) {
                document.getElementById("booking_date").value = dateStr;
            }
        });
    </script>
</x-app-layout>
