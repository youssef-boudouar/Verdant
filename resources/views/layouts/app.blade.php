<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Verdant - Premium Plants & Tools')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-neutral-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="/images/logo.png" alt="Verdant" class="h-10 w-auto">
                    <span class="text-xl lg:text-2xl font-light tracking-tight text-neutral-900">Verdant</span>
                </a>

                <!-- Right Navigation -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                        Catalog
                    </a>

                    @guest
                        <!-- Not Logged In -->
                        <a href="{{ route('login') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm">
                            Register
                        </a>
                    @else
                        <!-- Logged In -->

                        @if(auth()->user()->role === 'admin')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                Admin
                            </span>
                        @else
                            <!-- Favorites Link for Clients -->
                            <a href="{{ route('favorites.index') }}" class="flex items-center text-neutral-600 hover:text-emerald-600 transition-colors">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Favorites
                                @if(auth()->user()->favorites->count() > 0)
                                    <span class="ml-1 px-2 py-0.5 bg-emerald-100 text-emerald-800 text-xs rounded-full">
                                        {{ auth()->user()->favorites->count() }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        <!-- User Name -->
                        <span class="text-sm text-neutral-600 hidden md:block">
                            Hello, <span class="font-medium text-neutral-900">{{ auth()->user()->name }}</span>
                        </span>

                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center text-neutral-600 hover:text-red-600 transition-colors text-sm">
                                <svg class="w-5 h-5 md:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="hidden md:inline">Logout</span>
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                <p class="text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <p class="text-red-800">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-neutral-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="/images/logo.png" alt="Verdant" class="h-8 brightness-0 invert">
                        <span class="text-xl font-light">Verdant</span>
                    </div>
                    <p class="text-neutral-400 text-sm">
                        Cultivating excellence through premium plants and professional gardening solutions.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-medium mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Catalog</a></li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li><a href="{{ route('products.create') }}" class="hover:text-white transition-colors">Add Product</a></li>
                            @else
                                <li><a href="{{ route('favorites.index') }}" class="hover:text-white transition-colors">My Favorites</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="font-medium mb-4">Company</h3>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Sustainability</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-neutral-800 text-center">
                <p class="text-sm text-neutral-400">&copy; {{ date('Y') }} Verdant. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
