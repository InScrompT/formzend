@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" title="@lang('pagination.previous')" disabled>@lang('pagination.previous')</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous" title="@lang('pagination.previous')">@lang('pagination.previous')</a>
        @endif

        @foreach ($elements as $element)
            <ul class="pagination-list">
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="pagination-ellipsis">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page">{{ $page }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="pagination-link" aria-label="Goto page {{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" title="@lang('pagination.next')">@lang('pagination.next')</a>
        @else
            <a class="pagination-next" title="@lang('pagination.next')" aria-disabled="true" disabled>@lang('pagination.next')</a>
        @endif
    </nav>
@endif
