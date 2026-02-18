@extends('layouts.app')

@section('title', 'Role Management - Verdant')

@section('content')

<!-- Header Section -->
<section class="bg-neutral-100 border-b border-neutral-200 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl lg:text-4xl font-light text-neutral-900">Role Management</h1>
                <p class="text-neutral-600 mt-2">Manage roles and permissions for your team</p>
            </div>
            <a href="{{ route('roles.create') }}"
               class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors shadow-sm inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Role
            </a>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 border-b border-neutral-200">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg border border-neutral-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-neutral-600">Total Roles</p>
                    <p class="text-2xl font-semibold text-neutral-900 mt-1">{{ $roles->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-neutral-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-neutral-600">Total Permissions</p>
                    <p class="text-2xl font-semibold text-neutral-900 mt-1">{{ \Spatie\Permission\Models\Permission::count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-neutral-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-neutral-600">Custom Roles</p>
                    <p class="text-2xl font-semibold text-neutral-900 mt-1">{{ $roles->whereNotIn('name', ['admin', 'client'])->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Roles Table -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if($roles->isEmpty())
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <p class="text-neutral-500 text-lg">No roles found</p>
        </div>
    @else
        <div class="bg-white rounded-lg border border-neutral-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-neutral-50 border-b border-neutral-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-neutral-900">Role Name</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-neutral-900">Permissions</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-neutral-900">Users</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-neutral-900">Type</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-neutral-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200">
                    @foreach($roles as $role)
                        <tr class="hover:bg-neutral-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-semibold mr-3 shadow-sm">
                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-neutral-900">{{ ucfirst($role->name) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 border border-blue-200 text-sm rounded-full">
                                    {{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-neutral-100 text-neutral-800 text-sm rounded-full">
                                    {{ $role->users->count() }} {{ Str::plural('user', $role->users->count()) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if(in_array($role->name, ['admin', 'client']))
                                    <span class="px-3 py-1 bg-purple-50 text-purple-700 border border-purple-200 text-xs rounded-full font-medium">
                                        System Role
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs rounded-full font-medium">
                                        Custom Role
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('roles.edit', $role) }}"
                                       class="px-4 py-2 text-sm font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                        Edit
                                    </a>

                                    @if(!in_array($role->name, ['admin', 'client']) && $role->users->count() == 0)
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Delete {{ $role->name }} role?')"
                                                    class="px-4 py-2 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-4 py-2 text-sm font-medium text-neutral-400 bg-neutral-50 border border-neutral-200 rounded-lg cursor-not-allowed">
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
