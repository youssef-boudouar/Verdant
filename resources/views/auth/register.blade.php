<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Verdant</title>

    {{-- UI: Brand typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- UI: Tailwind configured with brand font --}}
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

    {{-- UI: Global polish — antialiasing, entrance animation --}}
    <style>
        body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.45s cubic-bezier(0, 0, 0.2, 1) forwards; }

        input { -webkit-appearance: none; -moz-appearance: none; appearance: none; }
        button:active { transform: scale(0.985); }
    </style>
</head>
<body class="font-sans bg-white">

    {{-- UI: Split-screen — matching login layout for consistent auth experience --}}
    <div class="min-h-screen flex">

        {{-- UI: Left brand panel — botanical imagery with gradient overlay --}}
        <div class="hidden lg:flex lg:w-[45%] relative overflow-hidden flex-col justify-between p-14"
             style="background-color: #0d1f0f;">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=1200&q=80"
                     alt=""
                     class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0d1f0f] via-[#0d1f0f]/20 to-transparent"></div>
            </div>

            <div class="relative z-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="/images/logo.png" alt="Verdant" class="h-8 brightness-0 invert opacity-80 transition-opacity group-hover:opacity-100">
                    <span class="text-xl font-light tracking-[-0.025em] text-white">Verdant</span>
                </a>
            </div>

            {{-- UI: Onboarding message tailored to new users --}}
            <div class="relative z-10">
                <blockquote>
                    <p class="text-white text-2xl font-light leading-relaxed tracking-tight mb-6">
                        "Begin your journey into the world of premium botanicals."
                    </p>
                    <footer class="flex items-center gap-3">
                        <div class="w-8 h-px bg-emerald-400"></div>
                        <cite class="text-sm text-neutral-400 not-italic tracking-wide">The Verdant Collection</cite>
                    </footer>
                </blockquote>

                {{-- UI: Value props for conversion --}}
                <div class="mt-10 space-y-3">
                    @foreach(['Curated plant collections', 'Save your favorite picks', 'Expert care guides included'] as $feature)
                        <div class="flex items-center gap-3 text-sm text-neutral-300">
                            <div class="w-4 h-4 rounded-full border border-emerald-500/50 flex items-center justify-center flex-shrink-0">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                            </div>
                            {{ $feature }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- UI: Right panel — registration form --}}
        <div class="flex-1 flex flex-col">

            {{-- UI: Mobile nav --}}
            <div class="lg:hidden flex items-center justify-between px-6 py-4 border-b border-neutral-100">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="/images/logo.png" alt="Verdant" class="h-8 w-auto">
                    <span class="text-lg font-light tracking-tight text-neutral-900">Verdant</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-sm text-neutral-500 hover:text-neutral-900 transition-colors">Catalog</a>
                    <a href="{{ route('login') }}" class="text-sm text-neutral-500 hover:text-neutral-900 transition-colors">Login</a>
                </div>
            </div>

            <div class="flex-1 flex items-center justify-center px-6 py-12 sm:px-12">
                <div class="w-full max-w-md fade-up">

                    {{-- UI: Heading — welcoming tone, light weight --}}
                    <div class="mb-10">
                        <h1 class="text-3xl font-light text-neutral-900 tracking-tight mb-2">Create your account</h1>
                        <p class="text-sm text-neutral-500">Join Verdant and start your green journey today.</p>
                    </div>

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-red-700 mb-1">Please fix the following:</p>
                                <ul class="text-xs text-red-600 space-y-0.5">
                                    @foreach($errors->all() as $error)
                                        <li>— {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Registration Form --}}
                    <form action="{{ route('register') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Full Name --}}
                        <div>
                            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Full Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('name') border-red-400 bg-red-50/30 @enderror"
                                placeholder="John Doe">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('email') border-red-400 bg-red-50/30 @enderror"
                                placeholder="you@example.com">
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Password
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('password') border-red-400 bg-red-50/30 @enderror"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-neutral-400">Minimum 8 characters</p>
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200"
                                placeholder="••••••••">
                        </div>

                        {{-- UI: Dark primary CTA button --}}
                        <button
                            type="submit"
                            class="w-full bg-neutral-900 text-white py-3.5 rounded-xl font-medium text-sm hover:bg-neutral-800 transition-all duration-150 shadow-sm mt-1 tracking-wide">
                            Create Account
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="mt-8 pt-7 border-t border-neutral-100 text-center">
                        <p class="text-sm text-neutral-500">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-medium ml-1 transition-colors">
                                Sign in
                            </a>
                        </p>
                    </div>

                    {{-- UI: Terms note — minimal, unobtrusive --}}
                    <p class="mt-6 text-center text-xs text-neutral-400">
                        By creating an account, you agree to our
                        <a href="#" class="text-neutral-600 hover:underline underline-offset-2">Terms of Service</a>
                        and
                        <a href="#" class="text-neutral-600 hover:underline underline-offset-2">Privacy Policy</a>
                    </p>

                </div>
            </div>
        </div>

    </div>

</body>
</html>
