@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md transition-colors">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ __('messages.edit_user') }}</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.name') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.role') }}</label>
            <select name="role" id="role" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-8 mb-4 border-t dark:border-gray-700 pt-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ __('messages.empty_password_hint') }}</p>
            
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.new_password') }}</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">{{ __('messages.back') }}</a>
            <button type="submit" class="bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 font-bold transition">{{ __('messages.update_user') }}</button>
        </div>
    </form>
</div>
@endsection
