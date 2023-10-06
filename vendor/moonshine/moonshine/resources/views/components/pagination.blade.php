@props([
    'simple' => false,
    'system' => false,
    'paginator',
    'elements' => []
])
@if ($paginator->hasPages())
    @if($simple)
        <ul class="pagination-list simple">
            {{-- Previous Page Link --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span class="pagination-simple disabled">
                        {!! __('moonshine::pagination.previous') !!}
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       @if($system) @click.prevent="canBeAsync" @endif
                       class="pagination-simple"
                    >
                        {!! __('moonshine::pagination.previous') !!}
                    </a>
                @endif
            </li>

            {{-- Next Page Link --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       @if($system) @click.prevent="canBeAsync" @endif
                       class="pagination-simple"
                    >
                        {!! __('moonshine::pagination.next') !!}
                    </a>
                @else
                    <span class="pagination-simple disabled">
                        {!! __('moonshine::pagination.next') !!}
                    </span>
                @endif
            </li>
        </ul>
    @else
    <!-- Pagination -->
    <div class="pagination">
        <ul class="pagination-list">
            @if (!$paginator->onFirstPage())
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}"
                       @if($system) @click.prevent="canBeAsync" @endif
                       class="pagination-first"
                       title="{!! __('moonshine::pagination.previous') !!}"
                    >
                        <x-moonshine::icon
                            icon="heroicons.chevron-double-left"
                            size="6"
                        />
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item">
                        <span class="pagination-dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="pagination-item">
                            <a href="{{ $url }}"
                               @if($system) @click.prevent="canBeAsync" @endif
                               class="pagination-page
                               @if ($page == $paginator->currentPage()) _is-active @endif"
                            >
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}"
                       @if($system) @click.prevent="canBeAsync" @endif
                       class="pagination-last"
                       title="{!! __('moonshine::pagination.next') !!}"
                    >
                        <x-moonshine::icon
                            icon="heroicons.chevron-double-right"
                            size="6"
                        />
                    </a>
                </li>
            @endif
        </ul>
        <div class="pagination-results">
            {!! __('moonshine::pagination.showing') !!}
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }}
                {!! __('moonshine::pagination.to') !!}
                {{ $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('moonshine::pagination.of') !!}
            {{ $paginator->total() }}
            {!! __('moonshine::pagination.results') !!}
        </div>
    </div>
    <!-- END: Pagination -->
    @endif
@endif
