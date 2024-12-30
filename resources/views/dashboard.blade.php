<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h3>Welcome {{ $user->name }}</h3>
                    <br><br>
                    <div class="container mx-auto py-8">
                        <h1 class="text-2xl font-bold mb-6">GitHub Repositories</h1>

                        @if ($pagedRepo->count() > 0)
                            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($pagedRepo as $repo)
                                    <li class="p-4 bg-white shadow rounded-lg border">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-2">
                                            <a href="{{ $repo['html_url'] }}" class="text-blue-500 hover:underline"
                                               target="_blank">
                                                {{ $repo['name'] }}
                                            </a>
                                        </h2>
                                        <p class="text-gray-600 text-sm">
                                            {{ $repo['description'] ?? 'No description available' }}
                                        </p>
                                        <p class="mt-2 text-gray-500 text-xs">
                                            ⭐ {{ $repo['stargazers_count'] ?? 0 }} | 🍴 {{ $repo['forks_count'] ?? 0 }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-8">
                                @if ($pagedRepo->hasPages())
                                    <nav class="flex justify-center mt-4">
                                        <ul class="inline-flex space-x-2">
                                            {{-- Previous Page Link --}}
                                            @if ($pagedRepo->onFirstPage())
                                                <li class="text-gray-500 px-4 py-2 bg-gray-100 rounded-lg cursor-not-allowed">
                                                    &laquo;
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $pagedRepo->previousPageUrl() }}"
                                                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">&laquo;</a>
                                                </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @foreach ($pagedRepo->links() as $element)
                                                {{-- Dots --}}
                                                @if (is_string($element))
                                                    <li class="px-4 py-2 bg-gray-100 text-gray-500 rounded-lg">{{ $element }}</li>
                                                @endif

                                                {{-- Links --}}
                                                @if (is_array($element))
                                                    @foreach ($element as $page => $url)
                                                        @if ($page == $pagedRepo->currentPage())
                                                            <li class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ $page }}</li>
                                                        @else
                                                            <li>
                                                                <a href="{{ $url }}"
                                                                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-300">{{ $page }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            {{-- Next Page Link --}}
                                            @if ($pagedRepo->hasMorePages())
                                                <li>
                                                    <a href="{{ $pagedRepo->nextPageUrl() }}"
                                                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">&raquo;</a>
                                                </li>
                                            @else
                                                <li class="text-gray-500 px-4 py-2 bg-gray-100 rounded-lg cursor-not-allowed">
                                                    &raquo;
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 text-center">No repositories found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
