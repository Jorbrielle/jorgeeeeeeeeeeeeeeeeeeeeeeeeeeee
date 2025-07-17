<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            overflow: hidden;
            position: relative;
            /* Darker cyan gradient */
            background: linear-gradient(135deg, #013737, #024a4a, #025a5a, #016666);
            background-size: 400% 400%;
            animation: shimmer 25s ease infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .ribbon {
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: repeating-linear-gradient(
                -45deg,
                rgba(0, 150, 170, 0.07) 0px,
                rgba(0, 150, 170, 0.07) 1px,
                transparent 1px,
                transparent 20px
            );
            animation: moveRibbon 20s linear infinite;
            z-index: 0;
        }

        @keyframes moveRibbon {
            0% {
                transform: translate(0%, 0%) rotate(0deg);
            }
            100% {
                transform: translate(50%, 50%) rotate(360deg);
            }
        }

        .center-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .form-wrapper {
            width: 100%;
            max-width: 700px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            padding: 2.5rem;
            border-radius: 1rem;
            border: 1px solid rgba(0, 150, 170, 0.3);
            box-shadow: 0 10px 30px rgba(0, 150, 170, 0.3);
            color: #ffffff;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #00b8cc;
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 0 0 10px rgba(0, 184, 204, 0.8);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #d0f0f5;
            text-shadow: 0 0 5px rgba(0, 184, 204, 0.6);
        }

        input[type="text"],
        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #00b8cc;
            border-radius: 0.5rem;
            font-size: 1rem;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.12);
            color: #e0f7fa;
            box-shadow: 0 0 12px rgba(0, 184, 204, 0.3);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #33c9de;
            box-shadow: 0 0 18px rgba(51, 201, 222, 0.7);
            background: rgba(255, 255, 255, 0.2);
        }

        .submit-btn {
            background-color: #00b8cc;
            color: #00363b;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 0 25px rgba(0, 184, 204, 0.6);
            transition: all 0.3s ease-in-out;
        }

        .submit-btn:hover {
            background-color: #009aad;
            box-shadow: 0 0 35px rgba(0, 154, 173, 0.9);
            color: #d0f0f5;
        }

        .error-box {
            background-color: rgba(255, 0, 0, 0.12);
            border: 1px solid rgba(255, 0, 0, 0.4);
            color: #ffdddd;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        #calendarBox {
            max-width: 100%;
            margin: 0 auto 1.5rem auto;
        }

        .flatpickr-calendar {
            font-size: 1.1rem !important;
            background: rgba(255, 255, 255, 0.1) !important;
            border: none !important;
            color: #d0f0f5 !important;
            box-shadow: 0 0 18px rgba(0, 184, 204, 0.6) !important;
            border-radius: 0.5rem !important;
        }

        .flatpickr-day {
            padding: 10px !important;
            font-size: 1rem !important;
            color: #d0f0f5 !important;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day:hover {
            background-color: #00b8cc !important;
            color: #00363b !important;
        }
    </style>

    <!-- Animated cyan ribbon background -->
    <div class="ribbon"></div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-300 leading-tight">
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
                    placeholder=""
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
                    placeholder="Any extra information..."
                >{{ old('notes') }}</textarea>

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
