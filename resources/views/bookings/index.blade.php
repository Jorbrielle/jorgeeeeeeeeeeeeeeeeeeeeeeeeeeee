<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">My Bookings</h2>
    </x-slot>

    <div class="main-container">
        <div class="animated-bg"></div>

        <div class="max-w-6xl mx-auto mt-10 px-6 relative z-10">
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

    {{-- Styling --}}
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .main-container {
            position: relative;
            min-height: 100vh;
        }

        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #006064, #00bcd4, #00acc1, #0097a7);
            background-size: 400% 400%;
            animation: shimmer 15s ease infinite;
            z-index: 0;
        }

        @keyframes shimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .page-header {
            font-size: 2.2rem;
            font-weight: 800;
            color: #e0f7fa;
            text-shadow: 0 0 12px rgba(0, 229, 255, 0.9);
            margin-bottom: 2rem;
            text-align: center;
            padding-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .alert-success {
            background: rgba(0, 229, 255, 0.2);
            color: #e0f7fa;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.5);
        }

        .animate-glow {
            animation: glowPulse 2s infinite;
        }

        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 10px rgba(0, 229, 255, 0.4); }
            50% { box-shadow: 0 0 25px rgba(0, 229, 255, 0.8); }
        }

        .no-bookings {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(0, 229, 255, 0.2);
            padding: 2.5rem;
            border-radius: 1rem;
            text-align: center;
            color: #e0f7fa;
            font-size: 1.1rem;
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.4);
            position: relative;
            z-index: 1;
        }

        .table-container {
            overflow-x: auto;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.4);
            border: 1px solid rgba(0, 188, 212, 0.2);
            padding: 1rem;
            margin-top: 2rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #e0f7fa;
            font-size: 1rem;
            text-align: center;
        }

        thead {
            background: rgba(0, 188, 212, 0.6);
            color: white;
            text-transform: uppercase;
        }

        th, td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(0, 188, 212, 0.1);
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            margin: 0 0.2rem;
        }

        .edit-btn {
            background: linear-gradient(to right, #00bcd4, #00838f);
            color: white;
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
        }

        .edit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.9);
        }

        .delete-btn {
            background: linear-gradient(to right, #f87171, #be123c);
            color: white;
            box-shadow: 0 0 10px rgba(248, 113, 113, 0.5);
        }

        .delete-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(248, 113, 113, 0.9);
        }

        .new-booking {
            margin-top: 3rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .btn-primary {
            background: linear-gradient(to right, #00bcd4, #00acc1);
            color: white;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.75rem;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 0 15px rgba(0, 188, 212, 0.6);
            transition: all 0.3s ease;
        }

        .glow-button:hover {
            transform: scale(1.07);
            box-shadow: 0 0 30px rgba(0, 188, 212, 0.8);
        }
    </style>
</x-app-layout>
