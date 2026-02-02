<!-- TODO: Extend layout -->
<!-- @extends('layouts.app') -->
<!-- @section('content') -->

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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 mb-16 lg:mb-24">

        <!-- Left: Product Image -->
        <div class="lg:sticky lg:top-24 lg:h-[calc(100vh-8rem)]">
            <div class="aspect-[4/5] lg:aspect-auto lg:h-full w-full overflow-hidden bg-neutral-100 rounded-sm">
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
                    <!-- Stock Status -->
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
            <div class="prose prose-neutral max-w-none">
                <h2 class="text-xl font-medium text-neutral-900 mb-4">Description</h2>
                <p class="text-neutral-600 leading-relaxed text-base">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Add to Cart Section -->
            <div class="lg:mt-12">
                <div class="sticky bottom-0 lg:static bg-white lg:bg-transparent p-4 lg:p-0 -mx-4 lg:mx-0 border-t lg:border-0 border-neutral-200 shadow-lg lg:shadow-none z-30">
                    <div class="max-w-md space-y-4">
                        <div class="flex items-center space-x-4">
                            <!-- Quantity Selector -->
                            <div class="flex items-center border border-neutral-300 rounded-lg overflow-hidden">
                                <button class="px-4 py-3 hover:bg-neutral-100 transition-colors text-neutral-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                </button>
                                <input type="text" value="1" class="w-16 text-center border-x border-neutral-300 py-3 focus:outline-none text-neutral-900 font-medium" readonly>
                                <button class="px-4 py-3 hover:bg-neutral-100 transition-colors text-neutral-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Add to Cart Button - Disabled if out of stock -->
                            <button class="flex-1 bg-emerald-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors disabled:bg-neutral-300 disabled:cursor-not-allowed"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}>
                                {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                            </button>
                        </div>

                        <!-- Wishlist Button -->
                        <button class="w-full border border-neutral-300 text-neutral-700 px-8 py-3 rounded-lg font-medium hover:bg-neutral-50 transition-colors flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span>Add to Wishlist</span>
                        </button>
                    </div>
                </div>
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

<!-- TODO: Close content section -->
<!-- @endsection -->
