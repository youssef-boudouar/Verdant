@extends('layouts.app')

@section('title', 'My Favorites - Verdant')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

    {{-- UI: Page header — light-weight heading, muted count below --}}
    <div class="mb-10">
        <h1 class="text-3xl lg:text-4xl font-light text-neutral-900 tracking-tight mb-2">My Favorites</h1>
        <p class="text-sm text-neutral-500">
            {{ $favorites->total() }} {{ $favorites->total() === 1 ? 'product' : 'products' }} saved
        </p>
    </div>

    @if($favorites->isEmpty())
        {{-- UI: Empty state — centred, icon container, clear CTA --}}
        <div class="text-center py-28 bg-white rounded-2xl border border-neutral-100 shadow-sm">
            <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-red-50 flex items-center justify-center">
                <svg class="w-8 h-8 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-medium text-neutral-900 mb-2">No favorites yet</h2>
            <p class="text-sm text-neutral-500 mb-8 max-w-xs mx-auto">Browse the catalog and save the plants and tools that inspire you.</p>
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-neutral-900 text-white text-sm font-medium rounded-xl hover:bg-neutral-800 transition-all duration-150 shadow-sm">
                Browse Products
            </a>
        </div>
    @else
        {{-- UI: Favorites grid — matching product card style for visual cohesion --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7">
            @foreach($favorites as $product)
                {{-- UI: Card — identical design system to products/index for consistency --}}
                <article class="group bg-white rounded-2xl border border-neutral-100 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5">

                    {{-- Image --}}
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="aspect-[4/5] overflow-hidden bg-neutral-100">
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.04]">
                        </div>
                    </a>

                    {{-- Info --}}
                    <div class="p-5 space-y-3.5">
                        <a href="{{ route('products.show', $product->id) }}" class="block">
                            {{-- UI: Category eyebrow --}}
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-1.5">
                                {{ $product->category->name }}
                            </p>
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-semibold text-neutral-900 group-hover:text-emerald-700 transition-colors duration-150 leading-snug line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <span class="text-base font-semibold text-emerald-600 whitespace-nowrap flex-shrink-0">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>
                        </a>

                        {{-- UI: Action pair — view (primary) + remove (ghost destructive) --}}
                        <div class="flex gap-2 pt-1">
                            <a href="{{ route('products.show', $product) }}"
                               class="flex-1 text-center px-4 py-2.5 bg-neutral-900 text-white text-xs font-semibold rounded-xl hover:bg-neutral-800 transition-all duration-150 tracking-wide">
                                View Details
                            </a>
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2.5 border border-red-200 bg-red-50 text-red-700 text-xs font-semibold rounded-xl hover:bg-red-100 transition-all duration-150 tracking-wide">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-14">
            {{ $favorites->links() }}
        </div>
    @endif

</div>

@endsection
