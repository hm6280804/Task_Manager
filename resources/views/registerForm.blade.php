<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Student Assessment System</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Top-bar styling */
        .top-bar {
            background: #023B7E;
            padding: 18px 20px;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
        }

        .logo {
            height: 42px;
        }

        .title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-size: 1.35rem;
            font-weight: 600;
        }

        /* Optional: top-right button (like logout) */
        .top-btn {
            margin-left: auto;
            background: #ffffff;
            color: #023B7E;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .top-btn:hover {
            background: #e6e6e6;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sign-Up Card -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-center text-2xl font-bold mb-6" style="color: #023B7E;">
                Sign Up
            </h2>
            
            <form method="POST" action="{{ route("process.register") }}">
                @csrf 
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input type="text" name="name" id="name" placeholder="Your Name" 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#023B7E]" >
                    @error('name')
                        <p class="text-red-600 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com" 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#023B7E]" >
                    @error('email')
                        <p class="text-red-600 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="********" 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#023B7E]">
                    @error('password')
                        <p class="text-red-600 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#023B7E]">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition duration-200" style="background-color: #023B7E;">
                    Sign Up
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-4">
                Already have an account? <a href="{{ route("login") }}" class="text-[#023B7E] font-semibold">Login</a>
            </p>
        </div>
    </div>

</body>
</html>
