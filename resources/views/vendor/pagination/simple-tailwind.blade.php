@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium 
                    text-gray-500 
                    bg-white border 
                    border-gray-300 
                    cursor-default leading-5 rounded-md shadow-sm shadow-black 
                    dark:text-gray-200 
                    dark:bg-transparent  
                    dark:border-gray-200">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium 
                text-gray-700 
                bg-white border 
                border-gray-300 
                leading-5 rounded-md focus:outline-none focus:ring transition ease-in-out duration-150 shadow-sm shadow-black
                hover:text-white
                hover:bg-[rgb(129,101,81)]  
                ring-gray-300 
                focus:border-blue-300 
                active:bg-gray-100 
                active:text-gray-700 
                dark:bg-[rgb(236,189,155)] 
                dark:border-gray-600 
                dark:text-black 
                dark:focus:border-blue-700 
                dark:active:bg-gray-700 
                dark:active:text-gray-300">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium 
                text-gray-700 
                bg-white border 
                border-gray-300 
                leading-5 rounded-md focus:outline-none focus:ring transition ease-in-out duration-150 shadow-sm shadow-black
                hover:text-white
                hover:bg-[rgb(129,101,81)]  
                ring-gray-300 
                focus:border-blue-300 
                active:bg-gray-100 
                active:text-gray-700 
                dark:bg-[rgb(236,189,155)] 
                dark:border-gray-600 
                dark:text-black 
                dark:focus:border-blue-700 
                dark:active:bg-gray-700 
                dark:active:text-gray-300">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium 
                    text-gray-500 
                    bg-white border 
                    border-gray-300 
                    cursor-default leading-5 rounded-md shadow-sm shadow-black 
                    dark:text-gray-200 
                    dark:bg-transparent  
                    dark:border-gray-200">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
