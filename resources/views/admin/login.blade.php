<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Locomotif</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .login-btn {
            width: 100%;
            background-color: #789DBC;
            color: white;
            font-weight: bold;
            padding: 12px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.2s;
        }
        .login-btn:hover {
            background-color: #6b8bb3;
        }
        .login-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px #789DBC;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#789DBC]">Locomotif</h1>
            <h2 class="text-xl font-semibold text-gray-700 mt-2">Admin Login</h2>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
                       required>
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
                       required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Login Button -->
            <div style="margin-bottom: 16px;">
                <button type="submit" class="login-btn">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>
</html>