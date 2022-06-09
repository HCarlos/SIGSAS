<div role="main" class="main-content m-0 p-0">
    <div class="row bgc-orange-lighten rounded m-0 p-0 ">
    @if( $items->total() > 1 )
        <div class="col-12 col-lg-6 pt-2">
{{--            <div class="action-buttons text-nowrap">--}}
            <div class="text-nowrap">
                @include('SIGSAS.xFiles.UI_Kit.__toolbar_catalogo')
            </div>
        </div>
        <div class="col-lg-6 col-12 pt-2">
            <div class="float-right ">
                {{ $items->onEachSide(1)->links() }}
            </div>
        </div>
    @else
        <div class="col-12" >
            @include('SIGSAS.xFiles.UI_Kit.__toolbar_catalogo')
        </div>
    @endif
    </div>
</div>
