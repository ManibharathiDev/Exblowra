<nav aria-label="Page navigation example" style="
    padding-top: 10px;
">
<ul class="pagination">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li class="disabled page-item">
            <a class="page-link" href="#">&laquo;</a>
            <!-- <span>&laquo;</span> -->
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
            <!-- <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a> -->
        </li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li class="disabled page-item">
                <a class="page-link" href="#">{{ $element }}</a>
                <!-- <span>{{ $element }}</span> -->
            </li>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active page-item">
                        <a class="page-link" href="#">{{ $page }}</a>
                        <!-- <span>{{ $page }}</span> -->
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="disabled page-item">
            <a class="page-link" href="#">&raquo;</a>
        </li>
    @endif
</ul>
</nav>