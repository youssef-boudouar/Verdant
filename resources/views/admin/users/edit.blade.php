@extends('layouts.app')

@section('title', 'Edit User - Verdant')

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
                <h1 class="text-3xl lg:text-4xl font-light text-neutral-900">Edit User</h1>
                <p class="text-neutral-600 mt-1">Update user information and permissions</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- User Badge -->
            <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4 flex items-center">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-xl mr-4 shadow-md">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-medium text-neutral-900">{{ $user->name }}</p>
                    <p class="text-sm text-neutral-600">Member since {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>

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
                    value="{{ old('name', $user->name) }}"
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
                    value="{{ old('email', $user->email) }}"
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
                    @if($user->id === auth()->id()) disabled @endif
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none bg-white @error('role') border-red-500 @enderror">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if($user->id === auth()->id())
                    <p class="mt-2 text-sm text-amber-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        You cannot change your own role for security reasons
                    </p>
                    <input type="hidden" name="role" value="{{ $user->role }}">
                @endif
            </div>

            <!-- Divider -->
            <div class="border-t border-neutral-200 pt-6">
                <h3 class="text-lg font-medium text-neutral-900 mb-1">Change Password (Optional)</h3>
                <p class="text-sm text-neutral-600">Leave blank to keep the current password unchanged</p>
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-neutral-900 mb-2">
                    New Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
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
                    Confirm New Password
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
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
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-neutral-300 text-neutral-700 rounded-lg font-medium hover:bg-neutral-50 transition-colors">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors inline-flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Update User</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- Warning Text -->
    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
        <div class="flex">
            <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-amber-900">Important Notice</h3>
                <p class="mt-1 text-sm text-amber-800">
                    Changes will be applied immediately. Ensure all information is accurate before updating.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection
