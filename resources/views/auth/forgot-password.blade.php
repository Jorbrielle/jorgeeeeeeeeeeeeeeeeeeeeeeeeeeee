<x-guest-layout>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e0f7fa;
            overflow: hidden;
            position: relative;
            background: linear-gradient(-45deg, #006064, #00bcd4, #00acc1, #0097a7);
            background-size: 400% 400%;
            animation: shimmer 15s ease infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Optional subtle cyan ribbon effect */
        .ribbon {
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: repeating-linear-gradient(
                -45deg,
                rgba(0, 188, 212, 0.05) 0px,
                rgba(0, 188, 212, 0.05) 1px,
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

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0 30px rgba(0, 188, 212, 0.3);
            max-width: 400px;
            margin: 4rem auto;
            position: relative;
            z-index: 1;
        }

        .glow-label {
            font-weight: 600;
            color: #00bcd4;
            text-shadow: 0 0 5px rgba(0, 188, 212, 0.8);
        }

        input[type="email"] {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #00bcd4;
            border-radius: 0.5rem;
            padding: 0.75rem;
            width: 100%;
            color: #e0f7fa;
            outline: none;
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.3);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="email"]:focus {
            box-shadow: 0 0 15px rgba(0, 188, 212, 0.6);
            border-color: #4dd0e1;
        }

        .btn-glow {
            background: #00bcd4;
            color: #00333a;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.6);
            transition: all 0.3s ease-in-out;
        }

        .btn-glow:hover {
            background: #00838f;
            box-shadow: 0 0 30px rgba(0, 131, 143, 0.8);
            color: #e0f7fa;
        }

        .description {
            margin-bottom: 1rem;
            color: #b2ebf2;
            text-align: center;
            font-size: 0.95rem;
        }

        .text-red-400 {
            color: #f87171;
        }
    </style>

    <!-- Animated cyan ribbon background -->
    <div class="ribbon"></div>

    <div class="form-container">
        <div class="description text-sm">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="glow-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn-glow">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
