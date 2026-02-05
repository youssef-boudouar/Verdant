<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Verdant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-50">

    <!-- Navigation (Same as index.blade.php) -->
    <nav class="bg-white shadow-sm border-b border-neutral-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="/images/logo.png" alt="Verdant" class="h-10 w-auto">
                    <span class="text-xl lg:text-2xl font-light tracking-tight text-neutral-900">Verdant</span>
                </a>

                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">Catalog</a>

                    @guest
                        <a href="{{ route('login') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">Register</a>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">Admin</span>
                        @else
                            <a href="{{ route('favorites.index') }}" class="flex items-center text-neutral-600 hover:text-emerald-600 transition-colors">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Favorites ({{ auth()->user()->favorites->count() }})
                            </a>
                        @endif

                        <span class="text-sm text-neutral-600">
                            Hello, <span class="font-medium text-neutral-900">{{ auth()->user()->name }}</span>
                        </span>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-neutral-600 hover:text-emerald-600 transition-colors">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

        <!-- Breadcrumbs -->
        <nav class="mb-6 lg:mb-8">
            <ol class="flex items-center space-x-2 text-sm text-neutral-500">
                <li><a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="/?category_id={{ $product->category_id }}" class="hover:text-emerald-600 transition-colors">{{ $product->category->name }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-neutral-900 font-medium truncate">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Product Detail Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

            <!-- Left: Product Image -->
            <div class="lg:sticky lg:top-24 lg:h-[calc(100vh-8rem)]">
                <div class="aspect-[4/5] lg:aspect-auto lg:h-full w-full overflow-hidden bg-neutral-100 rounded-lg">
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right: Product Details -->
            <div class="space-y-8">

                <!-- Title & Category -->
                <div>
                    <p class="text-sm uppercase tracking-wider text-emerald-600 font-medium mb-3">{{ $product->category->name }}</p>
                    <h1 class="text-3xl lg:text-5xl font-light text-neutral-900 leading-tight mb-4">{{ $product->name }}</h1>
                </div>

                <!-- Price & Stock -->
                <div class="flex items-center justify-between pb-8 border-b border-neutral-200">
                    <div>
                        <p class="text-4xl lg:text-5xl font-semibold text-emerald-600">${{ $product->price }}</p>
                    </div>
                    <div class="text-right">
                        @if($product->stock == 0)
                            <span class="inline-block px-3 py-1 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-full">
                                Out of Stock
                            </span>
                        @elseif($product->stock < 10)
                            <span class="inline-block px-3 py-1 bg-amber-50 text-amber-700 text-sm font-medium rounded-full">
                                Only {{ $product->stock }} in stock
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-sm font-medium rounded-full">
                                In Stock
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-xl font-medium text-neutral-900 mb-4">Description</h2>
                    <p class="text-neutral-600 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    @auth
                        <!-- Favorites Button -->
                        @if(auth()->user()->favorites->contains($product->id))
                            <!-- Favorites Button -->
<form action="{{ route('favorites.toggle', $product) }}" method="POST">
    @csrf
    @if(auth()->user()->role === 'client')
    <button type="submit" class="w-full flex items-center justify-center px-8 py-3 font-medium rounded-lg transition-colors
        @if(auth()->user()->favorites->contains($product->id))
            bg-red-50 border-2 border-red-200 text-red-700 hover:bg-red-100
        @else
            bg-emerald-50 border-2 border-emerald-200 text-emerald-700 hover:bg-emerald-100
        @endif">

        @if(auth()->user()->favorites->contains($product->id))
            <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            Remove from Favorites
        @else
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            Add to Favorites
        @endif
    </button>
</form>
                        @else
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-8 py-3 bg-emerald-50 border-2 border-emerald-200 text-emerald-700 font-medium rounded-lg hover:bg-emerald-100 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    Add to Favorites
                                </button>
                            </form>
                        @endif
                        @endif

                        <!-- Admin Actions -->
                        @if(auth()->user()->role === 'admin')
                            <div class="flex gap-3 pt-4 border-t border-neutral-200">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="flex-1 text-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    Edit Product
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                            class="w-full px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <!-- Guest - Prompt Login -->
                        <a href="{{ route('login') }}"
                           class="block text-center px-8 py-3 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                            Login to Add to Favorites
                        </a>
                    @endauth
                </div>

                <!-- Additional Info -->
                <div class="pt-8 border-t border-neutral-200 space-y-4 text-sm text-neutral-600">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Premium quality guarantee</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Free shipping on orders over $100</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>30-day satisfaction guarantee</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
