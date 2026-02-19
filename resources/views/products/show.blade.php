<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Verdant</title>

    {{-- UI: Brand typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- UI: Tailwind config with brand font --}}
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

    {{-- UI: Base styles for standalone page --}}
    <style>
        body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        select { -webkit-appearance: none; appearance: none; }
        button:active { transform: scale(0.985); }

        @keyframes pageFade {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .page-fade { animation: pageFade 0.3s ease-out forwards; }
    </style>
</head>
<body class="bg-neutral-50 font-sans page-fade">

    {{-- UI: Navigation — matching layout style for visual consistency --}}
    <nav class="bg-white/95 backdrop-blur-sm border-b border-neutral-200/80 sticky top-0 z-50 shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="/images/logo.png" alt="Verdant" class="h-9 w-auto transition-transform duration-200 group-hover:scale-105">
                    <span class="text-xl font-light tracking-[-0.025em] text-neutral-900">Verdant</span>
                </a>

                <div class="flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-all duration-150">
                        Catalog
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-all duration-150">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="ml-1 px-4 py-2 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-neutral-800 transition-all duration-150 shadow-sm">
                            Register
                        </a>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <span class="ml-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-semibold uppercase tracking-widest rounded-full border border-emerald-200/80">
                                Admin
                            </span>
                        @else
                            <a href="{{ route('favorites.index') }}" class="px-3 py-2 text-sm font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-all duration-150 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Favorites ({{ auth()->user()->favorites->count() }})
                            </a>
                        @endif

                        <div class="flex items-center gap-3 pl-3 ml-1 border-l border-neutral-200">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xs font-semibold shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-neutral-700 hidden sm:block">{{ auth()->user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-neutral-400 hover:text-neutral-700 transition-colors duration-150 font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-14">

        {{-- UI: Breadcrumb — refined separator, muted tones, hover emerald --}}
        <nav class="mb-8 lg:mb-10" aria-label="Breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-neutral-400">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors duration-150 font-medium">Home</a>
                </li>
                <li class="text-neutral-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li>
                    <a href="/?category_id={{ $product->category_id }}" class="hover:text-emerald-600 transition-colors duration-150 font-medium">
                        {{ $product->category->name }}
                    </a>
                </li>
                <li class="text-neutral-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="text-neutral-700 font-medium truncate max-w-[200px]">{{ $product->name }}</li>
            </ol>
        </nav>

        {{-- Product Detail Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-20">

            {{-- Left: Product Image --}}
            <div class="lg:sticky lg:top-24 lg:h-[calc(100vh-7rem)]">
                {{-- UI: Rounded-2xl image container with refined aspect ratio --}}
                <div class="aspect-[4/5] lg:aspect-auto lg:h-full w-full overflow-hidden bg-neutral-100 rounded-2xl shadow-sm">
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Right: Product Details --}}
            <div class="space-y-8 py-2">

                {{-- Title & Category --}}
                <div>
                    {{-- UI: Category label — eyebrow text style --}}
                    <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-emerald-600 mb-3">
                        {{ $product->category->name }}
                    </p>
                    {{-- UI: Product name — light weight for luxury feel at large size --}}
                    <h1 class="text-4xl lg:text-5xl font-light text-neutral-900 leading-[1.1] tracking-tight">
                        {{ $product->name }}
                    </h1>
                </div>

                {{-- Price & Stock --}}
                <div class="flex items-end justify-between pb-8 border-b border-neutral-100">
                    <div>
                        {{-- UI: Price — emerald accent, semibold, commanding presence --}}
                        <p class="text-4xl lg:text-5xl font-semibold text-emerald-600 tracking-tight">
                            ${{ number_format($product->price, 2) }}
                        </p>
                    </div>
                    {{-- UI: Stock badge — color-coded availability signal --}}
                    <div>
                        @if($product->stock == 0)
                            <span class="inline-block px-3 py-1.5 bg-neutral-100 text-neutral-600 text-xs font-semibold uppercase tracking-wider rounded-full">
                                Out of Stock
                            </span>
                        @elseif($product->stock < 10)
                            <span class="inline-block px-3 py-1.5 bg-amber-50 text-amber-700 text-xs font-semibold uppercase tracking-wider rounded-full border border-amber-200">
                                Only {{ $product->stock }} in stock
                            </span>
                        @else
                            <span class="inline-block px-3 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold uppercase tracking-wider rounded-full border border-emerald-200">
                                In Stock
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-neutral-400 mb-4">Description</h2>
                    <p class="text-neutral-600 leading-relaxed text-base">
                        {{ $product->description }}
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="space-y-3 pt-2">
                    @auth
                        {{-- Favorites Button --}}
                        @if(auth()->user()->favorites->contains($product->id))
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                                @csrf
                                @if(auth()->user()->role === 'client')
                                    {{-- UI: Toggle state — red when active for remove action --}}
                                    <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-8 py-4 font-medium text-sm rounded-2xl transition-all duration-150
                                        @if(auth()->user()->favorites->contains($product->id))
                                            bg-red-50 border border-red-200 text-red-700 hover:bg-red-100
                                        @else
                                            bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100
                                        @endif">
                                        @if(auth()->user()->favorites->contains($product->id))
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                            Remove from Favorites
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            Add to Favorites
                                        @endif
                                    </button>
                                @endif
                            </form>
                        @else
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                                @csrf
                                @if(auth()->user()->role === 'client')
                                    <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-8 py-4 bg-emerald-600 text-white font-medium text-sm rounded-2xl hover:bg-emerald-700 transition-all duration-150 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        Add to Favorites
                                    </button>
                                @endif
                            </form>
                        @endif

                        {{-- Admin Actions --}}
                        @if(auth()->user()->role === 'admin')
                            <div class="flex gap-3 pt-4 border-t border-neutral-100">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="flex-1 text-center px-6 py-3.5 bg-neutral-900 text-white text-sm font-semibold rounded-xl hover:bg-neutral-800 transition-all duration-150 tracking-wide">
                                    Edit Product
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                            class="w-full px-6 py-3.5 border border-red-200 bg-red-50 text-red-700 text-sm font-semibold rounded-xl hover:bg-red-100 transition-all duration-150">
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        {{-- UI: Guest CTA — prominent emerald button --}}
                        <a href="{{ route('login') }}"
                           class="flex items-center justify-center gap-2 px-8 py-4 bg-emerald-600 text-white text-sm font-medium rounded-2xl hover:bg-emerald-700 transition-all duration-150 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Sign in to Add to Favorites
                        </a>
                    @endauth
                </div>

                {{-- UI: Trust signals — icon-text pairs with generous spacing --}}
                <div class="pt-8 border-t border-neutral-100 space-y-3.5">
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-4">Included with every order</p>
                    @foreach([
                        'Premium quality guarantee',
                        'Free shipping on orders over $100',
                        '30-day satisfaction guarantee'
                    ] as $benefit)
                        <div class="flex items-center gap-3 text-sm text-neutral-600">
                            <div class="w-5 h-5 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            {{ $benefit }}
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

    {{-- UI: Matching footer --}}
    <footer class="bg-neutral-900 text-white pt-16 pb-10 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="pt-8 border-t border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <img src="/images/logo.png" alt="Verdant" class="h-6 brightness-0 invert opacity-60">
                    <span class="text-sm font-light text-neutral-400">Verdant</span>
                </div>
                <p class="text-xs text-neutral-500">&copy; {{ date('Y') }} Verdant. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
