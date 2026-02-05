<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Verdant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="/images/logo.png" alt="Verdant" class="h-10 w-auto">
                    <span class="text-xl lg:text-2xl font-light tracking-tight text-neutral-900">Verdant</span>
                </a>

                <!-- Links -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                        Catalog
                    </a>
                    <a href="{{ route('register') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-light text-neutral-900 mb-2">Welcome Back</h2>
                <p class="text-neutral-600">Sign in to your Verdant account</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-8">

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm text-red-800">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-emerald-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-900 mb-2">
                            Email Address
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                            placeholder="john@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-neutral-900">
                                Password
                            </label>
                            <a href="#" class="text-sm text-emerald-600 hover:text-emerald-700">
                                Forgot password?
                            </a>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-neutral-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-neutral-700">
                            Remember me for 30 days
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-emerald-600 text-white py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors shadow-sm">
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 pt-6 border-t border-neutral-200">
                    <p class="text-center text-sm text-neutral-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">
                            Create one now
                        </a>
                    </p>
                </div>
            </div>

            <!-- Test Accounts Info (Remove in production) -->
            <div class="mt-6 bg-neutral-100 border border-neutral-200 rounded-lg p-4">
                <p class="text-xs font-medium text-neutral-700 mb-2">Test Accounts:</p>
                <p class="text-xs text-neutral-600">Admin: admin@verdant.com / password</p>
                <p class="text-xs text-neutral-600">Client: client@verdant.com / password</p>
            </div>
        </div>
    </div>

</body>
</html>
