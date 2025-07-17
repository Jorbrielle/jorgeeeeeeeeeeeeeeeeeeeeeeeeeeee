<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Booking
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #fbcfe8, #be185d); /* Light to dark pink */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f2937;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        /* Floating hearts animation */
        .heart {
            position: absolute;
            width: 20px;
            height: 20px;
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Heart_corazón.svg/1024px-Heart_corazón.svg.png') no-repeat center/contain;
            animation: floatHearts 8s infinite ease-in;
            opacity: 0.6;
            z-index: 0;
        }

        .heart:nth-child(1) { left: 10%; animation-delay: 0s; }
        .heart:nth-child(2) { left: 25%; animation-delay: 2s; }
        .heart:nth-child(3) { left: 40%; animation-delay: 4s; }
        .heart:nth-child(4) { left: 60%; animation-delay: 1s; }
        .heart:nth-child(5) { left: 80%; animation-delay: 3s; }

        @keyframes floatHearts {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-200px) scale(1.2);
                opacity: 0.5;
            }
            100% {
                transform: translateY(-400px) scale(1.5);
                opacity: 0;
            }
        }

        .form-container {
            max-width: 720px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .form-container h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #be185d;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        input[type="text"],
        textarea,
        .flatpickr-input {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background-color: #f9fafb;
            margin-bottom: 1rem;
            color: #111827;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #ec4899;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.3);
        }

        .calendar-wrapper {
            margin-bottom: 1.5rem;
        }

        .submit-button {
            background-color: #ec4899;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
        }

        .submit-button:hover {
            background-color: #db2777;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #be185d;
            text-decoration: underline;
        }

        .error-box {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
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
            background-color: #be185d !important;
            color: white !important;
        }
    </style>

    <!-- Floating hearts -->
    <div class="heart"></div>
    <div class="heart"></div>
    <div class="heart"></div>
    <div class="heart"></div>
    <div class="heart"></div>

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
