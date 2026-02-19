@extends('layouts.app')

@section('title', 'Add New User - Verdant')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

    {{-- UI: Page header --}}
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-3">
            <a href="{{ route('admin.users.index') }}"
               class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-neutral-200 text-neutral-500 hover:text-neutral-900 hover:border-neutral-300 transition-all duration-150 shadow-sm flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-light text-neutral-900 tracking-tight">Add New User</h1>
                <p class="text-sm text-neutral-500 mt-0.5">Create a new user account</p>
            </div>
        </div>
    </div>

    {{-- UI: Form card --}}
    <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">

        <form action="{{ route('admin.users.store') }}" method="POST" class="divide-y divide-neutral-100">
            @csrf

            {{-- UI: Account Information section --}}
            <div class="p-6 lg:p-8 space-y-5">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Account Information</p>

                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        Full Name <span class="text-red-500 normal-case tracking-normal">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('name') border-red-400 bg-red-50/20 @enderror"
                        placeholder="John Doe">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        Email Address <span class="text-red-500 normal-case tracking-normal">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('email') border-red-400 bg-red-50/20 @enderror"
                        placeholder="john@example.com">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        User Role <span class="text-red-500 normal-case tracking-normal">*</span>
                    </label>
                    <select
                        id="role"
                        name="role"
                        required
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('role') border-red-400 @enderror">
                        <option value="">Select a role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                    @error('role')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    {{-- UI: Role description as inline help text --}}
                    <div class="mt-3 grid grid-cols-2 gap-3">
                        <div class="bg-neutral-50 rounded-xl p-3 border border-neutral-100">
                            <p class="text-xs font-semibold text-neutral-600 mb-0.5">Administrator</p>
                            <p class="text-xs text-neutral-400">Full access to manage products and users</p>
                        </div>
                        <div class="bg-neutral-50 rounded-xl p-3 border border-neutral-100">
                            <p class="text-xs font-semibold text-neutral-600 mb-0.5">Client</p>
                            <p class="text-xs text-neutral-400">Can browse products and manage favorites</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- UI: Security section --}}
            <div class="p-6 lg:p-8 space-y-5">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-1">Security</p>
                    <p class="text-xs text-neutral-400 mt-0.5">Set a secure password for this user</p>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        Password <span class="text-red-500 normal-case tracking-normal">*</span>
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('password') border-red-400 bg-red-50/20 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1.5 text-xs text-neutral-400">Minimum 8 characters required</p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        Confirm Password <span class="text-red-500 normal-case tracking-normal">*</span>
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200"
                        placeholder="••••••••">
                </div>
            </div>

            {{-- UI: Form actions --}}
            <div class="px-6 lg:px-8 py-5 bg-neutral-50/60 flex items-center justify-between">
                <p class="text-xs text-neutral-400"><span class="text-red-500">*</span> Required fields</p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-5 py-2.5 border border-neutral-200 text-neutral-600 text-sm font-medium rounded-xl hover:bg-neutral-100 hover:border-neutral-300 transition-all duration-150">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-xl hover:bg-neutral-800 transition-all duration-150 shadow-sm inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create User
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- UI: Security tips callout --}}
    <div class="mt-5 bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-emerald-900 mb-2">User Creation Tips</p>
                <ul class="text-sm text-emerald-800 space-y-1 leading-relaxed">
                    <li>• Use strong, unique passwords for all accounts</li>
                    <li>• Verify email addresses before granting admin access</li>
                    <li>• Review user roles regularly for security</li>
                    <li>• Users will receive credentials via secure channels</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection
