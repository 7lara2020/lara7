@if ($paginator->hasPages())
    <!-- <nav> -->
<div class="card-footer d-flex justify-content-between align-items-center w-100">
    <div class="dataTables_length" id="dataTable_length">
        <label>Show
            <select id='showPerPage' name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
            <option value="5" {{ $perPage == 5 ? "selected=selected" : "" }}>5</option>
                <option value="10" {{ $perPage == 10 ? "selected=selected" : "" }}>10</option>
                <option value="25" {{ $perPage==25 ? "selected=selected" : ""}}>25</option>
                <option value="50" {{ $perPage == 50 ? "selected=selected" : ""}}>50</option>
                <option value="100" {{ $perPage == 100 ? "selected=selected" : ""}}>100</option>
                <option value="500" {{ $perPage == 500 ? "selected=selected" : ""}}>500</option>
                <option value="1000" {{ $perPage == 1000 ? "selected=selected" : ""}}>1000</option>
            </select>
            Rows per page
        </label>
    </div>

    <span>
        <div>Showing {{($paginator->currentpage()-1)*$paginator->perpage()+1}} to {{$paginator->currentpage()*$paginator->perpage()}}
            of  {{$paginator->total()}} results
        </div>
    </span>
    
        <ul class="pagination d-flex justify-content-end align-items-center m-0">
        @if ($paginator->firstItem())
        <li class="page-item"><a class="btn btn-success" href="{{ $paginator->url(1) }}" rel="next">First</a></li>
        @else
        <li class="disabled page-item" aria-disabled="true"><button class="btn btn-success">First</button></li>
        @endif
        @if ($paginator->onFirstPage())
        <li class="disabled page-item" aria-disabled="true"><button class="btn btn-success"></i>@lang('pagination.previous')</button></li>
        @else
        <li class="page-item"><a class="btn btn-success" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif
        <li>
            <input onKeyUp="onKeyPressgGoJumpPage()"  name="goto_current_page" id="goto_current_page" value="{{$paginator->currentPage()}}" type="text" class="form-control mr-1 ml-1">
        </li>
        <li><span>of {{$paginator->lastPage()}}</span></li>
        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="btn btn-success" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
        <li class="disabled page-item" aria-disabled="true"><button class="btn btn-success">@lang('pagination.next')</button></li>
        @endif

        @if ($paginator->lastItem())
        <li class="page-item"><a class="btn btn-success" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next">Last</a></li>
        @else
        <li class="disabled page-item" aria-disabled="true"><button class="btn btn-success">Last</button></li>
        @endif
        </ul>
    <!-- </nav> -->
</div>
@endif
