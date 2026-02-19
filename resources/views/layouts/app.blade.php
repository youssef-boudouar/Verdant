<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Verdant - Premium Plants & Tools')</title>

    {{-- UI: Premium brand typography via Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- UI: Alpine.js — lightweight reactivity for hamburger toggle and other micro-interactions --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- UI: Configure Tailwind with brand font and precise easing --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>

    {{-- UI: Global base styles — antialiasing, smooth scroll, animations, custom controls --}}
    <style>
        html { scroll-behavior: smooth; }
        body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        /* UI: Flash message entrance animation */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .flash-message { animation: slideDown 0.25s cubic-bezier(0,0,.2,1) forwards; }

        /* UI: Page-level fade for perceived performance */
        @keyframes pageFade {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .page-fade { animation: pageFade 0.3s ease-out forwards; }

        /* UI: Polished custom select arrow replaces browser default */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.2em 1.2em;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* UI: Subtle press state for buttons */
        button:active, a.btn:active { transform: scale(0.985); }
    </style>
</head>
<body class="bg-neutral-50 font-sans page-fade">

    {{-- UI: Navigation — backdrop blur, refined spacing, avatar, and clear visual hierarchy --}}
    {{-- Alpine x-data scoped to <nav> so the hamburger state doesn't bleed into the page --}}
    <nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-sm border-b border-neutral-200/80 sticky top-0 z-50 shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- UI: Logo — always visible at every breakpoint --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="/images/logo.png" alt="Verdant" class="h-9 w-auto transition-transform duration-200 group-hover:scale-105">
                    <span class="text-xl font-light tracking-[-0.025em] text-neutral-900 select-none">Verdant</span>
                </a>

                {{-- UI: Desktop nav links — hidden below md, flex from md upward --}}
                <div class="hidden md:flex items-center gap-1">
                    {{-- Active state: pill is permanent when on the home/catalog route --}}
                    <a href="{{ route('home') }}"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('home') ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100' }}">
                        Catalog
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                           class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('login') ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100' }}">
                            Login
                        </a>
                        {{-- UI: Register CTA — filled dark button for strong visual priority --}}
                        <a href="{{ route('register') }}"
                           class="ml-1 px-4 py-2 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-neutral-800 transition-all duration-150 shadow-sm">
                            Register
                        </a>
                    @else
                        @role('admin')
                            <a href="{{ route('admin.users.index') }}"
                               class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('admin.users.*') ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100' }}">
                                Users
                            </a>
                            <a href="{{ route('roles.index') }}"
                               class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('roles.*') ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100' }}">
                                Roles
                            </a>
                            {{-- UI: Admin badge — refined pill, tight tracking for label aesthetic --}}
                            <span class="ml-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-semibold uppercase tracking-widest rounded-full border border-emerald-200/80 select-none">
                                Admin
                            </span>
                        @endrole

                        @role('client')
                            <a href="{{ route('favorites.index') }}"
                               class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-150 flex items-center gap-1.5 {{ request()->routeIs('favorites.index') ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100' }}">
                                {{-- UI: Heart icon for visual emphasis on favorites --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Favorites
                                <span class="text-neutral-400 text-xs">({{ auth()->user()->favorites->count() }})</span>
                            </a>
                        @endrole

                        {{-- UI: User section — avatar + name + logout, divided for clarity --}}
                        <div class="flex items-center gap-3 pl-3 ml-1 border-l border-neutral-200">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xs font-semibold shadow-sm flex-shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm text-neutral-700 font-medium hidden sm:block">{{ auth()->user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="text-sm text-neutral-400 hover:text-neutral-700 transition-colors duration-150 font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>

                {{-- UI: Hamburger — mobile only, toggles the dropdown drawer --}}
                <button
                    @click="open = !open"
                    aria-label="Toggle navigation"
                    class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg text-neutral-700 hover:bg-neutral-100 transition-colors duration-150">
                    {{-- 3-line icon when closed --}}
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    {{-- X icon when open --}}
                    <svg x-show="open" style="display:none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>
        </div>

        {{--
            UI: Mobile dropdown drawer — slides down below the 64px nav bar.
            Only visible below md. Contains every link the desktop nav has,
            stacked vertically with generous touch targets.
        --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1"
            @click.outside="open = false"
            style="display:none;"
            class="md:hidden bg-white border-b border-neutral-200 shadow-md">

            <div class="max-w-7xl mx-auto px-4 py-2 flex flex-col">

                {{-- Catalog --}}
                <a href="{{ route('home') }}"
                   @click="open = false"
                   class="px-4 py-3 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900 rounded-lg transition-colors duration-100 {{ request()->routeIs('home') ? 'text-neutral-900 font-semibold' : '' }}">
                    Catalog
                </a>

                @guest
                    <a href="{{ route('login') }}"
                       @click="open = false"
                       class="px-4 py-3 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900 rounded-lg transition-colors duration-100">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       @click="open = false"
                       class="px-4 py-3 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900 rounded-lg transition-colors duration-100">
                        Register
                    </a>
                @else
                    @role('admin')
                        <a href="{{ route('admin.users.index') }}"
                           @click="open = false"
                           class="px-4 py-3 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900 rounded-lg transition-colors duration-100 {{ request()->routeIs('admin.users.*') ? 'font-semibold' : '' }}">
                            Users
                        </a>
                        <a href="{{ route('roles.index') }}"
                           @click="open = false"
                           class="px-4 py-3 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900 rounded-lg transition-colors duration-100 {{ request()->routeIs('roles.*') ? 'font-semibold' : '' }}">
                            Roles
                        </a>
                    @endrole

                    @role('client')
                        <a href="{{ route('favorites.index') }}"
                           @click="open = false"
                           class="px-4 py-3 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900 rounded-lg transition-colors duration-100 flex items-center gap-2 {{ request()->routeIs('favorites.index') ? 'font-semibold' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            Favorites
                            <span class="text-neutral-400 text-xs">({{ auth()->user()->favorites->count() }})</span>
                        </a>
                    @endrole

                    {{-- UI: Mobile user row — name + logout separated by a top border --}}
                    <div class="mt-1 pt-2 border-t border-neutral-100 flex items-center justify-between px-4 py-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xs font-semibold shadow-sm flex-shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm text-neutral-700 font-medium">{{ auth()->user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="text-sm text-neutral-400 hover:text-neutral-700 transition-colors duration-150 font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                @endguest

            </div>
        </div>

    </nav>

    {{-- UI: Flash notifications — icons, rounded-xl, slide-in animation for polish --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="flash-message bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="flash-message bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    @yield('content')

    {{-- UI: Footer — generous spacing, uppercase section labels, dot-accent element --}}
    <footer class="bg-neutral-900 text-white pt-16 pb-10 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-neutral-800">

                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-2.5 mb-5">
                        <img src="/images/logo.png" alt="Verdant" class="h-8 brightness-0 invert opacity-70">
                        <span class="text-xl font-light tracking-[-0.025em]">Verdant</span>
                    </div>
                    <p class="text-neutral-400 text-sm leading-relaxed max-w-xs">
                        Cultivating excellence through premium plants and professional gardening solutions.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    {{-- UI: Uppercase label system for footer sections --}}
                    <h3 class="text-[11px] font-semibold uppercase tracking-widest text-neutral-500 mb-5">Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}" class="text-sm text-neutral-400 hover:text-white transition-colors duration-150">Catalog</a>
                        </li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <a href="{{ route('products.create') }}" class="text-sm text-neutral-400 hover:text-white transition-colors duration-150">Add Product</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('favorites.index') }}" class="text-sm text-neutral-400 hover:text-white transition-colors duration-150">My Favorites</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                {{-- Company --}}
                <div>
                    <h3 class="text-[11px] font-semibold uppercase tracking-widest text-neutral-500 mb-5">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors duration-150">About Us</a></li>
                        <li><a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors duration-150">Contact</a></li>
                        <li><a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors duration-150">Sustainability</a></li>
                    </ul>
                </div>
            </div>

            {{-- UI: Footer bottom — subtle emerald dot accent for brand warmth --}}
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-neutral-500">&copy; {{ date('Y') }} Verdant. All rights reserved.</p>
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-800"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
