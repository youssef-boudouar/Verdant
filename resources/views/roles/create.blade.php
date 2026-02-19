@extends('layouts.app')

@section('title', 'Create Role - Verdant')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

    {{-- UI: Page header --}}
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-3">
            <a href="{{ route('roles.index') }}"
               class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-neutral-200 text-neutral-500 hover:text-neutral-900 hover:border-neutral-300 transition-all duration-150 shadow-sm flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-light text-neutral-900 tracking-tight">Create New Role</h1>
                <p class="text-sm text-neutral-500 mt-0.5">Define a new role with specific permissions</p>
            </div>
        </div>
    </div>

    {{-- UI: Form card --}}
    <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">

        <form action="{{ route('roles.store') }}" method="POST" class="divide-y divide-neutral-100">
            @csrf

            {{-- UI: Role Identity section --}}
            <div class="p-6 lg:p-8 space-y-5">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400">Role Identity</p>

                {{-- Role Name --}}
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-neutral-500 mb-2">
                        Role Name <span class="text-red-500 normal-case tracking-normal">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-white border border-neutral-200 rounded-xl text-neutral-900 text-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/25 focus:border-emerald-400 transition-all duration-200 @error('name') border-red-400 bg-red-50/20 @enderror"
                        placeholder="e.g., moderator, editor, manager">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1.5 text-xs text-neutral-400">Choose a descriptive, lowercase name for this role</p>
                </div>
            </div>

            {{-- UI: Permissions section --}}
            <div class="p-6 lg:p-8 space-y-5">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-neutral-400 mb-1">Assign Permissions</p>
                    <p class="text-xs text-neutral-400 mt-0.5">Select which permissions this role should have</p>
                </div>

                {{-- UI: Grouped permission checkboxes — card-per-resource with refined checkbox labels --}}
                <div class="space-y-4">
                    @php
                        $groupedPermissions = $permissions->groupBy(function($permission) {
                            $parts = explode(' ', $permission->name);
                            return end($parts);
                        });
                    @endphp

                    @foreach($groupedPermissions as $resource => $perms)
                        {{-- UI: Permission group card --}}
                        <div class="bg-neutral-50 border border-neutral-100 rounded-2xl p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-6 h-6 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider text-neutral-700">
                                    {{ ucfirst($resource) }} Permissions
                                </h4>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($perms as $permission)
                                    {{-- UI: Permission checkbox — hover card with emerald accent --}}
                                    <label class="flex items-center gap-3 p-3 bg-white border border-neutral-200 rounded-xl hover:bg-emerald-50 hover:border-emerald-200 cursor-pointer transition-all duration-150 group">
                                        <input
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                            class="w-4 h-4 rounded border-neutral-300 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-0 cursor-pointer transition-colors">
                                        <span class="text-xs font-medium text-neutral-600 group-hover:text-neutral-900 transition-colors">
                                            {{ $permission->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- UI: Tips callout --}}
            <div class="px-6 lg:px-8 py-5">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4">
                    <div class="flex gap-3">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-xs font-semibold text-blue-900 mb-1.5">Permission Tips</p>
                            <ul class="text-xs text-blue-800 space-y-1 leading-relaxed">
                                <li>• Select only the permissions this role needs</li>
                                <li>• You can always edit permissions later</li>
                                <li>• Admin role already has all permissions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- UI: Form actions --}}
            <div class="px-6 lg:px-8 py-5 bg-neutral-50/60 flex items-center justify-between">
                <p class="text-xs text-neutral-400"><span class="text-red-500">*</span> Required fields</p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('roles.index') }}"
                       class="px-5 py-2.5 border border-neutral-200 text-neutral-600 text-sm font-medium rounded-xl hover:bg-neutral-100 hover:border-neutral-300 transition-all duration-150">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-xl hover:bg-neutral-800 transition-all duration-150 shadow-sm inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Role
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection
