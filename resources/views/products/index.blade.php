@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative h-[60vh] lg:h-[70vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-neutral-900 via-neutral-800 to-emerald-900">
        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=1920&q=80"
             alt="Hero"
             class="w-full h-full object-cover opacity-30 mix-blend-overlay">
    </div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-4xl lg:text-6xl xl:text-7xl font-light text-white mb-4 tracking-tight">Cultivating Excellence</h1>
        <p class="text-lg lg:text-xl text-neutral-300 font-light max-w-2xl mx-auto">Premium plants and professional tools for discerning spaces</p>
    </div>
</section>

<!-- Filter Bar -->
<section class="bg-white border-b border-neutral-200 sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all
                          @if(!request('category_id')) bg-emerald-600 text-white @else bg-neutral-100 text-neutral-700 hover:bg-neutral-200 @endif">
                    All Products
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('home', ['category_id' => $category->id]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all
                              @if(request('category_id') == $category->id) bg-emerald-600 text-white @else bg-neutral-100 text-neutral-700 hover:bg-neutral-200 @endif">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            <div class="text-sm text-neutral-500">
                {{ $products->total() }} products
            </div>
        </div>
    </div>
</section>

<!-- Admin Actions Bar -->
@auth
    @if(auth()->user()->role === 'admin')
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 border-b border-neutral-200">
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Product
            </a>
        </section>
    @endif
@endauth

<!-- Products Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">

    @if($products->isEmpty())
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <p class="text-neutral-500 text-lg">No products found</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            @foreach($products as $product)
                <article class="group bg-white rounded-lg border border-neutral-200 overflow-hidden">

                    <!-- Image Container -->
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="relative aspect-[4/5] overflow-hidden bg-neutral-100">
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                            @if ($product->stock < 5 && $product->stock > 0)
                                <div class="absolute top-4 right-4 bg-amber-500/90 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Only {{ $product->stock }} left
                                </div>
                            @elseif($product->stock == 0)
                                <div class="absolute top-4 right-4 bg-neutral-900/90 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Out of Stock
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Product Info -->
                    <div class="p-4 space-y-3">
                        <a href="{{ route('products.show', $product->id) }}">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="text-base lg:text-lg font-semibold text-neutral-900 group-hover:text-emerald-600 transition-colors line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <span class="text-base lg:text-lg font-semibold text-emerald-600 whitespace-nowrap">
                                    ${{ $product->price }}
                                </span>
                            </div>
                            <p class="text-sm text-neutral-500">{{ $product->category->name }}</p>
                        </a>

                        <!-- Action Buttons -->
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <!-- Admin Actions -->
                                <div class="flex gap-2 pt-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="flex-1 text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Delete this product?')"
                                                class="w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <!-- Favorites Button (All authenticated users) -->
                            @if(auth()->user()->favorites->contains($product->id))
                                <!-- Already favorited -->
                                <form action="{{ route('favorites.toggle', $product) }}" method="POST">
    @csrf
    @if(auth()->user()->role === 'client')
    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg transition-colors mt-2
        @if(auth()->user()->favorites->contains($product->id))
            bg-red-50 border border-red-200 text-red-700 hover:bg-red-100
        @else
            bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100
        @endif">

        @if(auth()->user()->favorites->contains($product->id))
            <svg class="w-4 h-4 mr-2 fill-current" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            Remove from Favorites
        @else
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            Add to Favorites
        @endif
    </button>
    @endif
</form>
                            @else
                                <!-- Not favorited -->

                                <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                                    @csrf
                                    @if(auth()->user()->role === 'client')
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium rounded-lg hover:bg-emerald-100 transition-colors mt-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        Add to Favorites
                                    </button>
                                    @endif
                                </form>

                            @endif
                        @else
                            <!-- Guest User -->
                            <a href="{{ route('login') }}" class="block text-center px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors mt-2">
                                Login to Add Favorites
                            </a>
                        @endauth
                    </div>
                </article>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @endif

</section>

@endsection
