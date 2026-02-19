@extends('layouts.app')

@section('title', 'Add New Product - Verdant')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

    {{-- UI: Page header — back arrow + heading in one line for spatial efficiency --}}
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-3">
            <a href="{{ route('home') }}"
               class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-neutral-200 text-neutral-500 hover:text-neutral-900 hover:border-neutral-300 transition-all duration-150 shadow-sm flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-light text-neutral-900 tracking-tight">Add New Product</h1>
                <p class="text-sm text-neutral-500 mt-0.5">Create a new product in your catalog</p>
            </div>
        </div>
    </div>

    {{-- UI: Form card — elevated with soft shadow, rounded-2xl for premium feel --}}
    <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">

        <form action="{{ route('products.store') }}" method="POST" class="divide-y divide-neutral-100">
            @csrf

            {{-- UI: Form section — Product Identity --}}
            <div class="p-6 lg:p-8 space-y-6">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-5">Product Identity</p>

                    {{-- Product Name --}}
                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Product Name <span class="text-red-500 normal-case tracking-normal">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200"
                                placeholder="e.g., Basilic Bio Premium">
                        </div>

                        {{-- Category --}}
                        <div>
                            <label for="category_id" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Category <span class="text-red-500 normal-case tracking-normal">*</span>
                            </label>
                            <select
                                id="category_id"
                                name="category_id"
                                required
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Description --}}
                        <div>
                            <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                                Description <span class="text-red-500 normal-case tracking-normal">*</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                required
                                class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 resize-none leading-relaxed"
                                placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- UI: Form section — Pricing & Inventory --}}
            <div class="p-6 lg:p-8">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-5">Pricing & Inventory</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Price --}}
                    <div>
                        <label for="price" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                            Price (USD) <span class="text-red-500 normal-case tracking-normal">*</span>
                        </label>
                        <div class="relative">
                            {{-- UI: Currency prefix inset in input --}}
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400 text-sm font-medium pointer-events-none">$</span>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                step="0.01"
                                min="0"
                                required
                                value="{{ old('price') }}"
                                class="w-full pl-8 pr-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200"
                                placeholder="0.00">
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label for="stock" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                            Stock Quantity <span class="text-red-500 normal-case tracking-normal">*</span>
                        </label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            min="0"
                            required
                            value="{{ old('stock') }}"
                            class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200"
                            placeholder="0">
                    </div>
                </div>
            </div>

            {{-- UI: Form section — Media --}}
            <div class="p-6 lg:p-8">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-5">Media</p>
                <div>
                    <label for="image_url" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        Image URL
                    </label>
                    <input
                        type="url"
                        id="image_url"
                        name="image_url"
                        value="{{ old('image_url') }}"
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200"
                        placeholder="https://example.com/image.jpg">
                    <p class="mt-2 text-xs text-neutral-400">Enter a valid image URL, or leave blank for the default placeholder.</p>
                </div>
            </div>

            {{-- UI: Form actions — right-aligned, clear primary/secondary hierarchy --}}
            <div class="px-6 lg:px-8 py-5 bg-neutral-50/60 flex items-center justify-between">
                <p class="text-xs text-neutral-400">
                    <span class="text-red-500">*</span> Required fields
                </p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}"
                       class="px-5 py-2.5 border border-neutral-200 text-neutral-600 text-sm font-medium rounded-xl hover:bg-neutral-100 hover:border-neutral-300 transition-all duration-150">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-xl hover:bg-neutral-800 transition-all duration-150 shadow-sm inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Product
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- UI: Tips callout — emerald-tinted info box, subtle not distracting --}}
    <div class="mt-5 bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-emerald-900 mb-2">Product Creation Tips</p>
                <ul class="text-sm text-emerald-800 space-y-1 leading-relaxed">
                    <li>• Use clear, descriptive product names</li>
                    <li>• Write detailed descriptions highlighting key features</li>
                    <li>• Set competitive prices based on market research</li>
                    <li>• Keep stock quantities updated to avoid overselling</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection
