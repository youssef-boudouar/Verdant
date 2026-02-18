@extends('layouts.app')

@section('title', 'Edit Role - Verdant')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('roles.index') }}" class="text-neutral-600 hover:text-emerald-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl lg:text-4xl font-light text-neutral-900">Edit Role</h1>
                <p class="text-neutral-600 mt-1">Update role name and permissions</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">

        <form action="{{ route('roles.update', $role) }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Role Badge -->
            <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4 flex items-center">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-xl mr-4 shadow-md">
                    {{ strtoupper(substr($role->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-medium text-neutral-900">{{ ucfirst($role->name) }} Role</p>
                    <p class="text-sm text-neutral-600">{{ $role->permissions->count() }} permissions • {{ $role->users->count() }} users</p>
                </div>
            </div>

            <!-- Role Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-neutral-900 mb-2">
                    Role Name <span class="text-red-600">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    value="{{ old('name', $role->name) }}"
                    @if(in_array($role->name, ['admin', 'client'])) readonly @endif
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if(in_array($role->name, ['admin', 'client']))
                    <p class="mt-2 text-sm text-amber-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        System roles cannot be renamed
                    </p>
                @endif
            </div>

            <!-- Divider -->
            <div class="border-t border-neutral-200 pt-6">
                <h3 class="text-lg font-medium text-neutral-900 mb-1">Manage Permissions</h3>
                <p class="text-sm text-neutral-600">Select which permissions this role should have</p>
            </div>

            <!-- Permissions Grid -->
            <div class="space-y-4">
                @php
                    $groupedPermissions = $permissions->groupBy(function($permission) {
                        $parts = explode(' ', $permission->name);
                        return end($parts);
                    });
                @endphp

                @foreach($groupedPermissions as $resource => $perms)
                    <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                        <h4 class="font-medium text-neutral-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ ucfirst($resource) }} Permissions
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($perms as $permission)
                                <label class="flex items-center space-x-3 p-3 bg-white border border-neutral-200 rounded-lg hover:bg-emerald-50 hover:border-emerald-300 cursor-pointer transition-all">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                        class="w-4 h-4 text-emerald-600 border-neutral-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-neutral-700">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Warning -->
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-amber-900">Important Notice</h3>
                        <p class="mt-1 text-sm text-amber-800">
                            Changes will affect all {{ $role->users->count() }} {{ Str::plural('user', $role->users->count()) }} with this role immediately.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-neutral-200">
                <a href="{{ route('roles.index') }}" class="px-6 py-3 border border-neutral-300 text-neutral-700 rounded-lg font-medium hover:bg-neutral-50 transition-colors">
                    Cancel
                </a>
                <button
                    type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors inline-flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Update Role</span>
                </button>
            </div>

        </form>

    </div>

</div>
@endsection

