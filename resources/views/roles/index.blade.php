@extends('layouts.app')

@section('title', 'Role Management - Verdant')

@section('content')

{{-- UI: Admin page header — dark band matching user management for cohesion --}}
<section class="bg-neutral-900 border-b border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-500 mb-2">Admin Panel</p>
                <h1 class="text-3xl font-light text-white tracking-tight">Role Management</h1>
                <p class="text-neutral-400 text-sm mt-1.5">Manage roles and permissions for your team</p>
            </div>
            <a href="{{ route('roles.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-500 transition-all duration-150 shadow-lg shadow-emerald-900/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Role
            </a>
        </div>
    </div>
</section>

{{-- UI: Stats bar --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Total Roles --}}
        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-3">Total Roles</p>
                    <p class="text-3xl font-light text-neutral-900">{{ $roles->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Permissions --}}
        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-3">Total Permissions</p>
                    <p class="text-3xl font-light text-neutral-900">{{ \Spatie\Permission\Models\Permission::count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Custom Roles --}}
        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-3">Custom Roles</p>
                    <p class="text-3xl font-light text-neutral-900">{{ $roles->whereNotIn('name', ['admin', 'client'])->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Roles Table --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

    @if($roles->isEmpty())
        <div class="text-center py-24 bg-white rounded-2xl border border-neutral-100 shadow-sm">
            <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-neutral-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <p class="text-lg font-medium text-neutral-900 mb-1">No roles found</p>
            <p class="text-sm text-neutral-500">Create the first role to get started.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="border-b border-neutral-100">
                    <tr class="bg-neutral-50">
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Role</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Permissions</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Users</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Type</th>
                        <th class="px-6 py-4 text-right text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-50">
                    @foreach($roles as $role)
                        <tr class="hover:bg-neutral-50/60 transition-colors duration-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    {{-- UI: Role avatar with initial --}}
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-sm font-semibold shadow-sm flex-shrink-0">
                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-semibold text-neutral-900">{{ ucfirst($role->name) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{-- UI: Permission count badge --}}
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider rounded-full bg-neutral-100 text-neutral-600">
                                    {{ $role->users->count() }} {{ Str::plural('user', $role->users->count()) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if(in_array($role->name, ['admin', 'client']))
                                    {{-- UI: System role badge --}}
                                    <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider rounded-full bg-purple-50 text-purple-700 border border-purple-200">
                                        System
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Custom
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('roles.edit', $role) }}"
                                       class="px-3.5 py-2 text-xs font-semibold text-neutral-700 bg-neutral-50 border border-neutral-200 rounded-lg hover:bg-neutral-100 hover:border-neutral-300 transition-all duration-150 tracking-wide">
                                        Edit
                                    </a>

                                    @if(!in_array($role->name, ['admin', 'client']) && $role->users->count() == 0)
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Delete {{ $role->name }} role?')"
                                                    class="px-3.5 py-2 text-xs font-semibold text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-all duration-150 tracking-wide">
                                                Delete
                                            </button>
                                        </form>
                                    @else
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
