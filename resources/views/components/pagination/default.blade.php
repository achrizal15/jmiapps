{{-- resources/views/vendor/pagination/default.blade.php --}}
@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation"
    class="flex items-center justify-between p-4 border-t select-none border-secondary-200 dark:border-secondary-600 sm:px-6">
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
        {{-- previous disable --}}
        <span
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-400 bg-white border border-gray-300 rounded dark:text-gray-400 dark:bg-secondary-700 dark:border-secondary-600">
            {!! __('pagination.previous') !!}
        </span>
        @else
        {{-- previous enable --}}
        <a href="{{ $paginator->previousPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 transition bg-white border border-gray-300 rounded dark:text-gray-200 dark:border-secondary-600 hover:text-gray-400 dark:hover:text-gray-300 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-300 focus:ring-opacity-30 dark:bg-secondary-700 dark:focus:ring-primary-500 dark:focus:ring-opacity-30">
            {!! __('pagination.previous') !!}
        </a>
        @endif
        {{-- next enable --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 transition bg-white border border-gray-300 rounded dark:text-gray-200 dark:border-secondary-600 hover:text-gray-400 dark:hover:text-gray-300 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-300 focus:ring-opacity-30 dark:bg-secondary-700 dark:focus:ring-primary-500 dark:focus:ring-opacity-30">
            {!! __('pagination.next') !!}
        </a>
        @else
        {{-- next disable --}}
        <span
            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-400 bg-white border border-gray-300 rounded dark:text-gray-400 dark:bg-secondary-700 dark:border-secondary-600">
            {!! __('pagination.next') !!}
        </span>
        @endif
    </div>

    <div class="flex-col hidden lg:flex-row sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm leading-5 dark:text-gray-300">
                {{ __('Showing') }}
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {{ __('to') }}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                {{ __('of') }}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {{ __('results') }}
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex mt-2 shadow-sm lg:mt-0">
                {{-- Previous Page Link Disable --}}
                @if ($paginator->onFirstPage())
                <a
                class="flex items-center justify-center w-10 h-10 text-indigo-300 transition-colors duration-150 rounded-full focus:shadow-outline">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg></a>
                @else
                {{-- Previous Page Link Enable --}}
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex items-center justify-center w-10 h-10 text-indigo-600 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-indigo-100">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg></a>

                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <button
                    class="w-10 h-10 text-indigo-600 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-indigo-100">{{ $element }}</button>

                @endif

                {{-- Array Of Links Disable --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <button
                    class="w-10 h-10 text-white transition-colors duration-150 bg-indigo-600 border border-r-0 border-indigo-600 rounded-full focus:shadow-outline">{{ $page }}</button>
                @else
                {{-- Array Of Links Enable --}}
                <a href="{{ $url }}"
                    class="w-10 h-10 text-indigo-600 flex items-center justify-center transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-indigo-100">{{ $page }}</a>
                @endif
                @endforeach
                @endif
                @endforeach
                {{-- Next Page Link Enable --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex items-center justify-center w-10 h-10 text-indigo-600 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-indigo-100">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg></a>
                @else
                {{-- Next Page Link Disable --}}
                <a
                    class="flex items-center justify-center w-10 h-10 text-indigo-300 transition-colors duration-150 bg-white rounded-full focus:shadow-outline">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg></a>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif
