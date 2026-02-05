@extends('layouts.app')

@section('title', 'My Favorites - Verdant')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-light text-neutral-900 mb-2">My Favorites</h1>
        <p class="text-neutral-600">{{ $favorites->total() }} products saved</p>
    </div>

    @if($favorites->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-lg border border-neutral-200">
            <svg class="w-20 h-20 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h2 class="text-2xl font-light text-neutral-900 mb-2">No favorites yet</h2>
            <p class="text-neutral-500 mb-6">Start adding products to your favorites!</p>
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                Browse Products
            </a>
        </div>
    @else
        <!-- Favorites Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($favorites as $product)
                <article class="bg-white rounded-lg border border-neutral-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Image -->
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="aspect-[4/5] overflow-hidden bg-neutral-100">
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                    </a>

                    <!-- Info -->
                    <div class="p-4 space-y-3">
                        <a href="{{ route('products.show', $product->id) }}">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-semibold text-neutral-900 hover:text-emerald-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <span class="text-emerald-600 font-semibold whitespace-nowrap">
                                    ${{ $product->price }}
                                </span>
                            </div>
                            <p class="text-sm text-neutral-500">{{ $product->category->name }}</p>
                        </a>

                        <!-- Actions -->
                        <div class="flex gap-2 pt-2">
    <a href="{{ route('products.show', $product) }}"
       class="flex-1 text-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
        View Details
    </a>
    <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="flex-1">
        @csrf
        <button type="submit"
                class="w-full px-4 py-2 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-lg hover:bg-red-100 transition-colors">
            Remove
        </button>
    </form>
</div>          
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $favorites->links() }}
        </div>
    @endif

</div>
@endsection
