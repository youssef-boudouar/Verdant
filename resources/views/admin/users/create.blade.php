@extends('layouts.app')

@section('title', 'Add New User - Verdant')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.users.index') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl lg:text-4xl font-light text-neutral-900">Add New User</h1>
                <p class="text-neutral-600 mt-1">Create a new user account</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-neutral-900 mb-2">
                    Full Name <span class="text-red-600">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                    placeholder="John Doe">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-neutral-900 mb-2">
                    Email Address <span class="text-red-600">*</span>
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                    placeholder="john@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-neutral-900 mb-2">
                    User Role <span class="text-red-600">*</span>
                </label>
                <select
                    id="role"
                    name="role"
                    required
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none bg-white @error('role') border-red-500 @enderror">
                    <option value="">Select a role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-neutral-500">
                    <strong>Admin:</strong> Full access to manage products and users<br>
                    <strong>Client:</strong> Can browse products and manage favorites
                </p>
            </div>

            <!-- Divider -->
            <div class="border-t border-neutral-200 pt-6">
                <h3 class="text-lg font-medium text-neutral-900 mb-1">Security</h3>
                <p class="text-sm text-neutral-600">Set a secure password for this user</p>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-neutral-900 mb-2">
                    Password <span class="text-red-600">*</span>
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-neutral-500">Minimum 8 characters required</p>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-neutral-900 mb-2">
                    Confirm Password <span class="text-red-600">*</span>
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    placeholder="••••••••">
            </div>

            <!-- Divider -->
            <div class="border-t border-neutral-200 pt-6">
                <p class="text-sm text-neutral-500 mb-4">
                    <span class="text-red-600">*</span> Required fields
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-neutral-300 text-neutral-700 rounded-lg font-medium hover:bg-neutral-50 transition-colors">
                    Cancel
                </a>
                <button
                    type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors inline-flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Create User</span>
                </button>
            </div>

        </form>

    </div>

    <!-- Help Text -->
    <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-lg p-4">
        <div class="flex">
            <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-emerald-900">User Creation Tips</h3>
                <div class="mt-2 text-sm text-emerald-800 space-y-1">
                    <p>• Use strong, unique passwords for all accounts</p>
                    <p>• Verify email addresses before granting admin access</p>
                    <p>• Review user roles regularly for security</p>
                    <p>• Users will receive credentials via secure channels</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
