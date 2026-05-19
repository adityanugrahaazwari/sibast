@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('messages.dashboard') }}</h1>
    <p class="text-gray-600 dark:text-gray-400">{{ __('messages.welcome_back') }}, <span class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</span>. {{ __('messages.system_summary') }}</p>
</div>

<!-- Statistik Cards -->
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    @if($user->isAdmin())
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-b-4 border-purple-500 transition-colors">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ __('messages.total_users') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-b-4 border-blue-500 transition-colors">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ __('messages.total_bast') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_bast'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-b-4 border-green-500 transition-colors">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ __('messages.total_items') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_items'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border-b-4 border-yellow-500 transition-colors">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ __('messages.total_value') }}</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($stats['total_value'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Activity -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden transition-colors">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-700/50">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ __('messages.recent_bast') }}</h3>
                <a href="{{ route('berita-acara.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('messages.view_all') }}</a>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($recentBast as $ba)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                    <div class="flex items-center">
                        <div class="bg-indigo-100 dark:bg-indigo-900/30 rounded-full p-2 text-indigo-600 dark:text-indigo-400 mr-4">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $ba->nama }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('messages.by') }}: {{ $ba->user->name ?? $user->name }} | {{ $ba->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">{{ __('messages.total') }}</p>
                        <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($ba->items->sum(fn($i) => $i->jumlah * $i->harga_satuan), 0, ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <div class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                    Belum ada aktivitas terbaru.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- User Profile Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden transition-colors">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ __('messages.account_info') }}</h3>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="h-16 w-16 bg-indigo-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $user->name }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold">{{ $user->role }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">{{ __('messages.email') }}</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">{{ __('messages.joined_at') }}</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="pt-4">
                        <a href="{{ route('profile.edit') }}" class="block w-full text-center bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition font-semibold text-sm">
                            {{ __('messages.edit_profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
