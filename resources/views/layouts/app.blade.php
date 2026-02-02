<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="TOKEN_HERE">
    <title>Verdant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
    </style>
</head>
<body class="antialiased bg-neutral-50 text-neutral-900" x-data="{ mobileMenuOpen: false }">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <img src="/images/logo.png" alt="Logo"

     class="h-8 w-10 rounded-full object-cover">
                    <span class="text-xl lg:text-2xl font-light tracking-tight text-neutral-900">Verdant</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-neutral-700 hover:text-emerald-600 transition-colors">Catalog</a>




                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Search..." class="pl-4 pr-10 py-2 text-sm border border-neutral-300 rounded-full focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all w-48 focus:w-64">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">
                            <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-neutral-700">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-neutral-200 bg-white"
             x-cloak>
            <div class="px-4 py-6 space-y-4">
                <!-- TODO: Add route to home page -->
                <a href="#" class="block text-base font-medium text-neutral-700 hover:text-emerald-600 transition-colors">Catalog</a>

                <!-- TODO: Loop through categories -->
                 {{-- @foreach($categories as $category) --}}
                <a href="#" class="block text-base font-medium text-neutral-700 hover:text-emerald-600 transition-colors">Plantes</a>
                <a href="#" class="block text-base font-medium text-neutral-700 hover:text-emerald-600 transition-colors">Graines</a>
                <a href="#" class="block text-base font-medium text-neutral-700 hover:text-emerald-600 transition-colors">Outils</a>
                 {{-- @endforeach --}}

                <!-- TODO: Add search form with proper action -->
                <form action="#" method="GET" class="pt-4">
                    <input type="text" name="search" placeholder="Search products..." class="w-full px-4 py-2 text-sm border border-neutral-300 rounded-full focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- TODO: Add @yield('content') or content slot here -->
        <!-- Content will be injected here -->
    </main>

    <!-- Footer -->
    <footer class="bg-neutral-900 text-neutral-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">

                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-7 h-7 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 18c-3.31-1.04-6-5.26-6-9.5V8.27l6-3.16 6 3.16V10.5c0 4.24-2.69 8.46-6 9.5z"/>
                            <path d="M12 6L7 8.5v3.17c0 2.83 1.79 5.47 4 6.33.35.14.65.14 1 0 2.21-.86 4-3.5 4-6.33V8.5L12 6z"/>
                        </svg>
                        <span class="text-xl font-light text-white">Verdant</span>
                    </div>
                    <p class="text-sm leading-relaxed max-w-md">Cultivating excellence through premium plants and professional gardening solutions. Elevating spaces with nature's finest.</p>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-white font-medium mb-4 text-sm uppercase tracking-wider">Categories</h3>
                    <ul class="space-y-2">
                        <!-- TODO: Loop through categories -->
                         {{-- @foreach($categories as $category)  --}}
                        <li><a href="#" class="text-sm hover:text-emerald-500 transition-colors">Plantes</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-500 transition-colors">Graines</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-500 transition-colors">Outils</a></li>
                         {{-- @endforeach  --}}
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-white font-medium mb-4 text-sm uppercase tracking-wider">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm hover:text-emerald-500 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-500 transition-colors">Contact</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-500 transition-colors">Sustainability</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-neutral-800 text-center">
                <!-- TODO: Add dynamic year -->
                <p class="text-sm">&copy; 2026 Verdant. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
