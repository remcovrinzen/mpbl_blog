@if ($paginator->hasPages())
<nav class="pagination is-centered m-t-lg" role="navigation" aria-label="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <a class="pagination-previous" aria-disabled="true" aria-label="@lang('pagination.previous')" disabled> @lang('pagination.previous') </a>
    @else
    <a class="pagination-previous" aria-label="@lang('pagination.previous')" href="{{ $paginator->previousPageUrl() }}" rel="prev"> @lang('pagination.previous') </a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')" rel="next"> @lang('pagination.next') </a>
    @else
    <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')" rel="next" disabled> @lang('pagination.next') </a>
    @endif

    {{-- Pagination Elements --}}
    <ul class="pagination-list">
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li><span class="pagination-ellipsis" class="disabled" aria-disabled="true">&hellip;</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li><a class="pagination-link is-current" aria-label="Pagina {{ $page }}" aria-current="page">{{ $page }}</a></li>
        @else
        <li><a class="pagination-link" aria-label="Pagina {{ $page }}" aria-current="page" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach
    </ul>
</nav>
@endif