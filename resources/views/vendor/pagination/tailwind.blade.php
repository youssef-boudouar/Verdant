{{--
    Verdant custom pagination — matches the design system:
    • Active page : filled black circle (bg-neutral-900, w-9 h-9 rounded-full)
    • Inactive pages : plain number, no border (text-neutral-600 hover:text-neutral-900)
    • Prev/Next : chevron icons only, no border
    • No box borders on any element
--}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex items-center justify-center gap-1 flex-wrap">

            {{-- Previous page arrow --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                      class="inline-flex items-center justify-center w-9 h-9 text-neutral-300 cursor-not-allowed pointer-events-none select-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   aria-label="{{ __('pagination.previous') }}"
                   class="inline-flex items-center justify-center w-9 h-9 text-neutral-600 hover:text-neutral-900 transition-colors duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Page number elements --}}
            @foreach ($elements as $element)

                {{-- Ellipsis separator --}}
                @if (is_string($element))
                    <span aria-disabled="true"
                          class="inline-flex items-center justify-center w-9 h-9 text-sm text-neutral-400 select-none">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array of page links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- Active page: filled black circle --}}
                            <span aria-current="page"
                                  class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-neutral-900 text-white text-sm font-semibold select-none">
                                {{ $page }}
                            </span>
                        @else
                            {{-- Inactive page: plain number, no border --}}
                            <a href="{{ $url }}"
                               aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                               class="inline-flex items-center justify-center w-9 h-9 text-sm text-neutral-600 hover:text-neutral-900 transition-colors duration-150">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next page arrow --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   aria-label="{{ __('pagination.next') }}"
                   class="inline-flex items-center justify-center w-9 h-9 text-neutral-600 hover:text-neutral-900 transition-colors duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                      class="inline-flex items-center justify-center w-9 h-9 text-neutral-300 cursor-not-allowed pointer-events-none select-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif

        </div>
    </nav>
@endif
