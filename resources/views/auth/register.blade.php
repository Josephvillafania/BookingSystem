<x-guest-layout>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3b82f6, #9333ea); /* Modern gradient */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        form {
            background: rgba(0, 0, 0, 0.5); /* Darker background with transparency */
            padding: 3rem 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 0;
            backdrop-filter: blur(12px);
        }

        form::before {
            content: "";
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, #6366f1, #7c3aed);
            background-size: 400% 400%;
            border-radius: inherit;
            z-index: -2;
            animation: glow-border 8s linear infinite;
        }

        @keyframes glow-border {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: #ddd;
        }

        input {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.5rem;
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
            border-radius: 0.8rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 8px rgba(124, 58, 237, 0.6);
            outline: none;
            background-color: #444;
        }

        .error {
            color: #f87171;
            font-size: 0.85rem;
            margin-top: -0.9rem;
            margin-bottom: 1.25rem;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        .form-footer a {
            font-size: 0.9rem;
            color: #bbb;
            text-decoration: none;
        }

        .form-footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        button {
            background: linear-gradient(90deg, #6366f1, #7c3aed);
            background-size: 400%;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 0.8rem;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(124, 58, 237, 0.6);
            animation: rainbowBtn 6s ease infinite;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(124, 58, 237, 0.8);
        }

        @keyframes rainbowBtn {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @media (max-width: 500px) {
            form {
                padding: 2.5rem 1.5rem;
            }
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 style="text-align:center; font-size:1.8rem; margin-bottom:2rem; font-weight:bold; color: #fff;">Create Account</h2>

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
