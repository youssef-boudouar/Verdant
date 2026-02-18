@extends('layouts.app')

@section('title', 'Create Role - Verdant')

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
                <h1 class="text-3xl lg:text-4xl font-light text-neutral-900">Create New Role</h1>
                <p class="text-neutral-600 mt-1">Define a new role with specific permissions</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">

        <form action="{{ route('roles.store') }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf

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
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                    placeholder="e.g., moderator, editor, manager">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-neutral-500">Choose a descriptive name for this role</p>
            </div>

            <!-- Divider -->
            <div class="border-t border-neutral-200 pt-6">
                <h3 class="text-lg font-medium text-neutral-900 mb-1">Assign Permissions</h3>
                <p class="text-sm text-neutral-600">Select which permissions this role should have</p>
            </div>

            <!-- Permissions Grid -->
            <div class="space-y-4">
                @php
                    $groupedPermissions = $permissions->groupBy(function($permission) {
                        $parts = explode(' ', $permission->name);
                        return end($parts); // Get last word (products, users, etc.)
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
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                        class="w-4 h-4 text-emerald-600 border-neutral-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-neutral-700">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Select All Helper -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-900">Permission Tips</h3>
                        <div class="mt-2 text-sm text-blue-800 space-y-1">
                            <p>• Select only the permissions this role needs</p>
                            <p>• You can always edit permissions later</p>
                            <p>• Admin role already has all permissions</p>
                        </div>
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
                    <span>Create Role</span>
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
