<x-guest-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff66cc, #66ccff); /* pink and blue gradient */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Bubble animation */
        .bubble {
            position: absolute;
            bottom: -100px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: rise 10s infinite ease-in;
        }

        @keyframes rise {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0.7;
            }
            100% {
                transform: translateY(-120vh) scale(1.5);
                opacity: 0;
            }
        }

        /* Customize positions and timing */
        .bubble:nth-child(1) { left: 10%; animation-delay: 0s; width: 25px; height: 25px; }
        .bubble:nth-child(2) { left: 25%; animation-delay: 2s; width: 35px; height: 35px; }
        .bubble:nth-child(3) { left: 40%; animation-delay: 4s; width: 20px; height: 20px; }
        .bubble:nth-child(4) { left: 55%; animation-delay: 1s; width: 30px; height: 30px; }
        .bubble:nth-child(5) { left: 70%; animation-delay: 3s; width: 50px; height: 50px; }
        .bubble:nth-child(6) { left: 85%; animation-delay: 5s; width: 15px; height: 15px; }

        .content-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            max-width: 480px;
            width: 100%;
            z-index: 1;
            color: #fff;
        }

        .content-box p,
        .content-box div {
            color: #f1f5f9;
        }

        .underline:hover {
            text-decoration: underline;
        }
    </style>

    <!-- Bubbles -->
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <div class="content-box">
        <div class="mb-4 text-sm">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-300">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="underline text-sm text-white hover:text-pink-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
