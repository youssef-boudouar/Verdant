
<!-- @extends('layouts.app') -->
<!-- @section('content') -->

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">

            <a href="{{ route('products.index') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl lg:text-4xl font-light text-neutral-900">Edit Product</h1>
                <p class="text-neutral-600 mt-1">Update product information</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">

        <form action="{{ route('products.update', $product) }}" method="POST" class="p-6 lg:p-8 space-y-6">
         @csrf
         @method('PUT')

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-neutral-900 mb-2">
                    Product Name <span class="text-red-600">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                     value="{{ $product->name }}"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="e.g., Basilic Bio Premium">
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-neutral-900 mb-2">
                    Category <span class="text-red-600">*</span>
                </label>
                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none bg-white">
                    <option value="">Select a category</option>

                    @foreach($categories as $category)
    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
        {{ $category->name }}
    </option>
@endforeach
                </select>

            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-neutral-900 mb-2">
                    Description <span class="text-red-600">*</span>
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    required
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"
                    placeholder="Describe your product in detail...">{{ $product->description }}</textarea>

            </div>

            <!-- Price and Stock (Grid) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-neutral-900 mb-2">
                        Price ($) <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-500">$</span>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            step="0.01"
                            min="0"
                            required
                            value="{{ $product->price }}"
                            class="w-full pl-8 pr-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            placeholder="0.00">
                    </div>
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-neutral-900 mb-2">
                        Stock Quantity <span class="text-red-600">*</span>
                    </label>
                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        min="0"
                        required
                        value="{{ $product->stock }}"
                        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                        placeholder="0">
                </div>
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_url" class="block text-sm font-medium text-neutral-900 mb-2">
                    Image URL
                </label>
                <input
                    type="url"
                    id="image_url"
                    name="image_url"
                    value="{{ $product->image_url }}"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="https://example.com/image.jpg">
                <p class="mt-2 text-sm text-neutral-500">Enter a valid image URL or leave blank for default placeholder</p>
            </div>


            <!-- Divider -->
            <div class="border-t border-neutral-200 pt-6">
                <p class="text-sm text-neutral-500 mb-4">
                    <span class="text-red-600">*</span> Required fields
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('products.index') }}" class="px-6 py-3 border border-neutral-300 text-neutral-700 rounded-lg font-medium hover:bg-neutral-50 transition-colors">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors inline-flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Update Product</span>
                    </button>
                </div>

            </div>

        </form>
    </div>

    <!-- Help Text -->
    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
        <div class="flex">
            <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-amber-900">Important Notice</h3>
                <p class="mt-1 text-sm text-amber-800">
                    Changes will be immediately visible to customers. Make sure all information is accurate before updating.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- @endsection -->
