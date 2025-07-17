<x-guest-layout>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #006064, #00bcd4); /* Cyan gradient background */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        form {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 2.5rem 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: #e0f7fa; /* Light cyan for labels */
        }

        input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.25rem;
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
            border: 1px solid #80deea; /* Light cyan border for inputs */
            border-radius: 0.6rem;
            font-size: 1rem;
            transition: 0.3s;
        }

        input:focus {
            border-color: #00bcd4; /* Cyan border when focused */
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
            outline: none;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .error {
            color: #ffb3b3;
            font-size: 0.85rem;
            margin-top: -0.9rem;
            margin-bottom: 1rem;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        .form-footer a {
            font-size: 0.9rem;
            color: #80deea;
            text-decoration: none;
        }

        .form-footer a:hover {
            color: #00bcd4;
            text-decoration: underline;
        }

        button {
            background: linear-gradient(to right, #00bcd4, #00796b); /* Cyan gradient button */
            background-size: 200% auto;
            color: white;
            padding: 0.7rem 1.4rem;
            border: none;
            border-radius: 0.6rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 12px rgba(0, 188, 212, 0.4);
            animation: shimmer 4s ease-in-out infinite;
            transition: transform 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.6);
        }

        @keyframes shimmer {
            0% { background-position: 0% center; }
            50% { background-position: 100% center; }
            100% { background-position: 0% center; }
        }

        @media (max-width: 500px) {
            form {
                padding: 2rem 1.5rem;
            }
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 style="text-align:center; font-size:1.7rem; margin-bottom:1.5rem; font-weight:bold;">Create Account</h2>

        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-footer">
            <a href="{{ route('login') }}">Already registered?</a>
            <button type="submit">Register</button>
        </div>
    </form>
</x-guest-layout>
