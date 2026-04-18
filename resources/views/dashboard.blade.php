<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome Banner --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Here's a summary of your invitation cards.
                </p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 flex items-center gap-4">
                    <div class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Cards</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $totalCards }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 flex items-center gap-4">
                    <div class="bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">This Month</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $thisMonth }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 flex items-center gap-4">
                    <div class="bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Account</p>
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>

            </div>

            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-4">Quick Actions</h4>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('cards.create') }}"
                       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Card
                    </a>
                    <a href="{{ route('cards.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium px-4 py-2 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        View All Cards
                    </a>
                </div>
            </div>

            {{-- Recent Cards --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-4">Recent Cards</h4>

                @forelse ($recentCards as $card)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $card->title }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $card->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('cards.show', $card->id) }}"
                               class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">View</a>
                            <a href="{{ route('cards.edit', $card->id) }}"
                               class="text-xs text-gray-500 dark:text-gray-400 hover:underline">Edit</a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 dark:text-gray-500 text-center py-6">No cards yet. Create your first one!</p>
                @endforelse

                @if ($totalCards > 5)
                    <div class="mt-4 text-center">
                        <a href="{{ route('cards.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            View all {{ $totalCards }} cards →
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
