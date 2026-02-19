@extends('layouts.app')

@section('title', 'Edit User - Verdant')

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
                <h1 class="text-3xl font-light text-neutral-900 tracking-tight">Edit User</h1>
                <p class="text-sm text-neutral-500 mt-0.5">Update user information and permissions</p>
            </div>
        </div>
    </div>

    {{-- UI: Form card --}}
    <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="divide-y divide-neutral-100">
            @csrf
            @method('PUT')

            {{-- UI: User identity badge — avatar + name + since, contextual awareness --}}
            <div class="p-6 lg:p-8">
                <div class="flex items-center gap-4 bg-neutral-50 rounded-2xl p-4 border border-neutral-100">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-xl shadow-md flex-shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-neutral-900">{{ $user->name }}</p>
                        <p class="text-xs text-neutral-500 mt-0.5">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

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
                        value="{{ old('name', $user->name) }}"
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
                        value="{{ old('email', $user->email) }}"
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
                        @if($user->id === auth()->id()) disabled @endif
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('role') border-red-400 @enderror @if($user->id === auth()->id()) opacity-60 cursor-not-allowed bg-neutral-50 @endif">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                    @error('role')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    @if($user->id === auth()->id())
                        {{-- UI: Self-edit role warning --}}
                        <div class="mt-3 flex items-start gap-2 text-amber-700 bg-amber-50 border border-amber-100 rounded-xl px-3 py-2.5">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-xs">You cannot change your own role for security reasons.</p>
                        </div>
                        <input type="hidden" name="role" value="{{ $user->role }}">
                    @endif
                </div>
            </div>

            {{-- UI: Password change section --}}
            <div class="p-6 lg:p-8 space-y-5">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-1">Change Password</p>
                    <p class="text-xs text-neutral-400 mt-0.5">Leave blank to keep the current password unchanged</p>
                </div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        New Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
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
                        Confirm New Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
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
                        Update User
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- UI: Warning callout --}}
    <div class="mt-5 bg-amber-50 border border-amber-100 rounded-2xl p-5">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-amber-900 mb-1">Important Notice</p>
                <p class="text-sm text-amber-800 leading-relaxed">
                    Changes will be applied immediately. Ensure all information is accurate before updating.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection
