<x-guest-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3b0a45, #7b2cbf); /* dark pink to dark purple */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Falling Leaves Animation */
        .leaf {
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgba(255, 192, 203, 0.8);
            border-radius: 0 50% 50% 50%;
            transform: rotate(45deg);
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-10%) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Randomize leaf positions */
        @for $i from 1 through 15 {
            .leaf:nth-child(#{$i}) {
                left: #{random(100)}vw;
                animation-duration: #{random(10) + 5}s;
                animation-delay: #{random(10)}s;
                background-color: hsla(330 + #{random(60)}, 70%, 70%, 0.7);
            }
        }

        /* Fallback for Blade since we can't use SCSS directly */
        .leaf:nth-child(1)  { left: 5%;  animation-duration: 9s; animation-delay: 1s; background-color: #f7c3e2; }
        .leaf:nth-child(2)  { left: 15%; animation-duration: 7s; animation-delay: 2s; background-color: #e091d9; }
        .leaf:nth-child(3)  { left: 25%; animation-duration: 8s; animation-delay: 3s; background-color: #da70d6; }
        .leaf:nth-child(4)  { left: 35%; animation-duration: 10s; animation-delay: 4s; background-color: #f4a6c2; }
        .leaf:nth-child(5)  { left: 45%; animation-duration: 6s; animation-delay: 5s; background-color: #ec92c3; }
        .leaf:nth-child(6)  { left: 55%; animation-duration: 9s; animation-delay: 1s; background-color: #f7b2d9; }
        .leaf:nth-child(7)  { left: 65%; animation-duration: 7s; animation-delay: 2s; background-color: #de91d4; }
        .leaf:nth-child(8)  { left: 75%; animation-duration: 8s; animation-delay: 3s; background-color: #d26fcb; }
        .leaf:nth-child(9)  { left: 85%; animation-duration: 10s; animation-delay: 4s; background-color: #ffafd7; }
        .leaf:nth-child(10) { left: 95%; animation-duration: 6s; animation-delay: 5s; background-color: #eaa3d2; }

        /* Form Styling */
        form {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            z-index: 1;
            width: 100%;
            max-width: 400px;
        }

        .mb-4 {
            color: #f5d0fe;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>

    <!-- Falling Leaves Elements -->
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>
    <div class="leaf"></div>

    <div class="mb-4 text-sm">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
