<div class="row bg-dark-lighten rounded ">
    @if( $items->total() > 15 )
        <div class="col-md-6 mb-0" >
            @include('SIGSAS.xFiles.UI_Kit.__toolbar_respuesta')
        </div>
        <div class="col-md-6 ">
            <div class="mt-md-2">
                {{ $items->onEachSide(1)->links() }}
            </div>
        </div>
    @else
        <div class="col-md-12 mb-0" >
            @include('SIGSAS.xFiles.UI_Kit.__toolbar_respuesta')
        </div>
    @endif
</div>
