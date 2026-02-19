@extends('layouts.app')

@section('title', 'User Management - Verdant')

@section('content')

{{-- UI: Admin page header — dark band for authority, clean typographic hierarchy --}}
<section class="bg-neutral-900 border-b border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-500 mb-2">Admin Panel</p>
                <h1 class="text-3xl font-light text-white tracking-tight">User Management</h1>
                <p class="text-neutral-400 text-sm mt-1.5">Manage all system users and their roles</p>
            </div>
            {{-- UI: Primary CTA — emerald on dark background for contrast pop --}}
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-500 transition-all duration-150 shadow-lg shadow-emerald-900/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New User
            </a>
        </div>
    </div>
</section>

{{-- UI: Stats bar — KPI cards with icon containers, consistent padding --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Total Users --}}
        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-3">Total Users</p>
                    <p class="text-3xl font-light text-neutral-900">{{ count($users) }}</p>
                </div>
                {{-- UI: Icon container — emerald tint for primary metric --}}
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Administrators --}}
        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-3">Administrators</p>
                    <p class="text-3xl font-light text-neutral-900">{{ $users->where('role', 'admin')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Clients --}}
        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-3">Clients</p>
                    <p class="text-3xl font-light text-neutral-900">{{ $users->where('role', 'client')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Users Table --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

    @if($users->isEmpty())
        <div class="text-center py-24 bg-white rounded-2xl border border-neutral-100 shadow-sm">
            <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-neutral-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="text-lg font-medium text-neutral-900 mb-1">No users found</p>
            <p class="text-sm text-neutral-500">Create the first user to get started.</p>
        </div>
    @else
        {{-- UI: Table card — subtle border, no heavy shadow --}}
        <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">
            <table class="w-full">
                {{-- UI: Table header — uppercase labels for column identity --}}
                <thead class="border-b border-neutral-100">
                    <tr class="bg-neutral-50">
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">User</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Email</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Role</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Joined</th>
                        <th class="px-6 py-4 text-right text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-50">
                    @foreach($users as $user)
                        {{-- UI: Table row — subtle hover, fast transition --}}
                        <tr class="hover:bg-neutral-50/60 transition-colors duration-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    {{-- UI: Avatar — gradient with initial, consistent with nav --}}
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-sm font-semibold shadow-sm flex-shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-neutral-900">{{ $user->name }}</div>
                                        @if($user->id === auth()->id())
                                            <span class="text-[11px] font-semibold text-emerald-600 uppercase tracking-wider">You</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-neutral-500">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{-- UI: Role badge — colour-coded pill with micro-icon --}}
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider rounded-full
                                    {{ $user->role === 'admin'
                                        ? 'bg-red-50 text-red-700 border border-red-200'
                                        : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                    <svg class="w-2.5 h-2.5 fill-current" viewBox="0 0 20 20">
                                        @if($user->role === 'admin')
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        @else
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        @endif
                                    </svg>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-neutral-700">{{ $user->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-neutral-400 mt-0.5">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="px-3.5 py-2 text-xs font-semibold text-neutral-700 bg-neutral-50 border border-neutral-200 rounded-lg hover:bg-neutral-100 hover:border-neutral-300 transition-all duration-150 tracking-wide">
                                        Edit
                                    </a>

                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Delete {{ $user->name }}? This action cannot be undone.')"
                                                    class="px-3.5 py-2 text-xs font-semibold text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-all duration-150 tracking-wide">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        {{-- UI: Disabled state — greyed out, cursor blocked --}}
                                        <span class="px-3.5 py-2 text-xs font-semibold text-neutral-300 bg-neutral-50 border border-neutral-100 rounded-lg cursor-not-allowed tracking-wide">
                                            Delete
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</section>

@endsection
