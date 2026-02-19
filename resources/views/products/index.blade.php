@extends('layouts.app')

@section('content')

{{--
    Hero: Compact editorial layout — 40vh keeps the section visually impactful while
    ensuring the filter bar + top of the product grid are visible on 1080p screens.
    Composition shifts from centered to left-aligned: the botanical image bleeds right,
    text anchors left, creating natural directional flow down into the catalog.
--}}
<section class="relative h-[40vh] min-h-[260px] flex items-center overflow-hidden bg-neutral-950">

    {{-- Background layer: image + dual-axis gradient for legibility at any viewport width --}}
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=1920&q=80"
             alt=""
             class="w-full h-full object-cover opacity-30 mix-blend-luminosity">

        {{-- Left vignette: guarantees headline contrast over image at all times --}}
        <div class="absolute inset-0 bg-gradient-to-r from-neutral-950 via-neutral-950/75 to-transparent"></div>

        {{-- Bottom fade: blends the section edge cleanly into the filter bar below --}}
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-neutral-950/60 to-transparent"></div>
    </div>

    {{-- Content: left-anchored editorial block, max-width constrains reading column --}}
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg lg:max-w-2xl">

            {{-- Eyebrow: collection identifier in tight uppercase — establishes brand register --}}
            <p class="text-[11px] font-semibold uppercase tracking-[0.3em] text-emerald-400 mb-4">
                The Verdant Collection
            </p>

            {{--
                Headline: scaled from 8xl → 6xl for the reduced height.
                Single line at xl avoids awkward wrapping; tight negative tracking
                preserves the premium character at the smaller size.
            --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-light text-white tracking-[-0.025em] leading-[1.08] mb-4">
                Cultivating Excellence
            </h1>

            {{-- Subtext: slightly reduced size and line length for fast scanning at this height --}}
            <p class="text-sm lg:text-base text-neutral-400 font-light leading-relaxed max-w-xs lg:max-w-sm">
                Premium plants and professional tools for discerning spaces
            </p>

        </div>
    </div>

    {{--
        Scroll cue: bottom-center pulse indicator.
        Keyframes defined inline — zero dependencies, pure CSS.
        A hairline + minimal chevron reads as intentional editorial detail,
        not a generic UI affordance. Clicks scroll to the filter/grid section.
    --}}
    <style>
        @keyframes verdantScroll {
            0%, 100% { opacity: 0.6;  transform: translateY(0); }
            55%       { opacity: 0.22; transform: translateY(8px); }
        }
    </style>

    <div class="absolute bottom-7 left-1/2 -translate-x-1/2 z-10 pointer-events-none">
        <button
            onclick="this.closest('section').nextElementSibling.scrollIntoView({behavior:'smooth'})"
            aria-label="Scroll to catalog"
            class="flex flex-col items-center gap-1.5 bg-transparent border-0 p-2 cursor-pointer pointer-events-auto"
            style="animation: verdantScroll 2.4s cubic-bezier(0.4,0,0.6,1) infinite;">
            {{-- Hairline: thin vertical accent — grounds the chevron, adds editorial weight --}}
            <span style="display:block;width:1px;height:20px;background:rgba(255,255,255,0.22);border-radius:1px;"></span>
            {{-- Chevron: single clean stroke, sized to feel crafted not stock --}}
            <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M1 1L8 8L15 1" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

</section>

{{-- UI: Filter bar — sticky, clean white with soft shadow for depth separation --}}
<section class="bg-white border-b border-neutral-200 sticky top-16 z-40 shadow-[0_2px_8px_rgba(0,0,0,0.05)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 lg:py-4">
        <div class="flex items-center justify-between flex-wrap gap-3">

            {{-- UI: Category pill filters — active state uses dark fill for strong selection signal --}}
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('home') }}"
                   class="px-4 py-1.5 rounded-full text-sm font-medium transition-all duration-150
                          @if(!request('category_id'))
                              bg-neutral-900 text-white shadow-sm
                          @else
                              bg-neutral-100 text-neutral-600 hover:bg-neutral-200 hover:text-neutral-900
                          @endif">
                    All
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('home', ['category_id' => $category->id]) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all duration-150
                              @if(request('category_id') == $category->id)
                                  bg-neutral-900 text-white shadow-sm
                              @else
                                  bg-neutral-100 text-neutral-600 hover:bg-neutral-200 hover:text-neutral-900
                              @endif">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            {{-- UI: Search input — sits between category pills and sort/count group --}}
            <form action="{{ route('search') }}" method="GET" class="flex-shrink-0">
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                <div class="relative">
                    {{-- Search icon: left-inset, non-interactive --}}
                    <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                        <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="w-48 lg:w-64 pl-9 pr-4 py-1.5 rounded-full border border-neutral-200 bg-white text-sm text-neutral-700 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-150">
                </div>
            </form>

            {{-- UI: Sort control + product count — right-aligned for visual balance --}}
            <div class="flex items-center gap-4">
                <form action="{{ route('home') }}" method="GET" class="flex items-center gap-2">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif

                    {{-- UI: Refined sort select — custom arrow via layout CSS --}}
                    <select name="sort"
                            onchange="this.form.submit()"
                            class="px-3 py-1.5 rounded-lg border border-neutral-200 text-sm text-neutral-700 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-150 cursor-pointer">
                        <option value="">Default</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low → High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High → Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A–Z</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    </select>
                </form>

                {{-- UI: Product count as subtle metadata --}}
                <span class="text-sm text-neutral-400 font-medium whitespace-nowrap">
                    {{ $products->total() }} <span class="hidden sm:inline">products</span>
                </span>
            </div>
        </div>
    </div>
</section>

{{-- Admin Actions Bar --}}
@auth
    @if(auth()->user()->role === 'admin')
        {{-- UI: Admin action integrated into flow, not visually competing --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-xl hover:bg-neutral-800 transition-all duration-150 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Product
            </a>
        </section>
    @endif
@endauth

{{-- Products Grid --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">

    @if($products->isEmpty())
        {{-- UI: Empty state — centred, generous padding, muted illustration --}}
        <div class="text-center py-24">
            <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-neutral-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-neutral-900 mb-2">No products found</h3>
            <p class="text-sm text-neutral-500">Try selecting a different category or removing filters.</p>
        </div>
    @else
        {{-- UI: Product grid — tighter gap on mobile, wider on desktop --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7">

            @foreach($products as $product)
                {{-- UI: Product card — rounded-2xl, subtle border, shadow on hover with smooth transition --}}
                <article class="group bg-white rounded-2xl border border-neutral-100 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5">

                    {{-- Image Container --}}
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="relative aspect-[4/5] overflow-hidden bg-neutral-100">
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.04]">

                            {{-- UI: Stock badges — refined pill with backdrop blur --}}
                            @if ($product->stock < 5 && $product->stock > 0)
                                <div class="absolute top-3 right-3 bg-amber-500/90 backdrop-blur-sm text-white text-[11px] font-semibold px-2.5 py-1 rounded-full tracking-wide">
                                    Only {{ $product->stock }} left
                                </div>
                            @elseif($product->stock == 0)
                                <div class="absolute top-3 right-3 bg-neutral-900/80 backdrop-blur-sm text-white text-[11px] font-semibold px-2.5 py-1 rounded-full tracking-wide">
                                    Out of Stock
                                </div>
                            @endif
                        </div>
                    </a>

                    {{-- Product Info --}}
                    <div class="p-5 space-y-3.5">
                        <a href="{{ route('products.show', $product->id) }}" class="block">
                            {{-- UI: Category label — tiny uppercase for information hierarchy --}}
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-1.5">
                                {{ $product->category->name }}
                            </p>
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="text-base font-semibold text-neutral-900 group-hover:text-emerald-700 transition-colors duration-150 line-clamp-1 leading-snug">
                                    {{ $product->name }}
                                </h3>
                                {{-- UI: Price — emerald accent, semibold weight for scannability --}}
                                <span class="text-base font-semibold text-emerald-600 whitespace-nowrap flex-shrink-0">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>

                            {{-- UI: Description — 2-line clamp gives context without overwhelming the card --}}
                            @if($product->description)
                                <p class="text-sm text-neutral-500 leading-relaxed line-clamp-2 mt-2">
                                    {{ $product->description }}
                                </p>
                            @endif
                        </a>

                        {{-- Action Buttons --}}
                        @auth
                            @if(auth()->user()->role === 'admin')
                                {{-- UI: Admin action pair — distinct visual weight per action type --}}
                                <div class="flex gap-2 pt-1">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="flex-1 text-center px-3 py-2 bg-neutral-900 text-white text-xs font-semibold rounded-lg hover:bg-neutral-800 transition-all duration-150 tracking-wide">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Delete this product?')"
                                                class="w-full px-3 py-2 border border-red-200 bg-red-50 text-red-700 text-xs font-semibold rounded-lg hover:bg-red-100 transition-all duration-150 tracking-wide">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif

                            {{-- Favorites Button --}}
                            @if(auth()->user()->favorites->contains($product->id))
                                <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                                    @csrf
                                    @if(auth()->user()->role === 'client')
                                        {{-- UI: Active favorite — filled heart, red-tinted for clear state --}}
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150
                                            @if(auth()->user()->favorites->contains($product->id))
                                                bg-red-50 border border-red-200 text-red-700 hover:bg-red-100
                                            @else
                                                bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100
                                            @endif">
                                            @if(auth()->user()->favorites->contains($product->id))
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                </svg>
                                                Remove from Favorites
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        {{-- UI: Inactive favorite — emerald tint for positive action --}}
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium rounded-xl hover:bg-emerald-100 transition-all duration-150">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            Add to Favorites
                                        </button>
                                    @endif
                                </form>
                            @endif
                        @else
                            {{-- UI: Guest prompt — neutral, non-intrusive --}}
                            <a href="{{ route('login') }}"
                               class="block text-center px-4 py-2.5 bg-neutral-50 border border-neutral-200 text-neutral-600 text-sm font-medium rounded-xl hover:bg-neutral-100 transition-all duration-150">
                                Sign in to save favorites
                            </a>
                        @endauth
                    </div>
                </article>
            @endforeach

        </div>

        {{-- UI: Pagination — generous top margin --}}
        <div class="mt-14">
            {{ $products->links() }}
        </div>
    @endif

</section>

@endsection
