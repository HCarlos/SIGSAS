<div class="row">
    <div class="col-lg-12">
        <ul class="media-list">
            @foreach($items as $item)
                @if(count($item->childs))
                    @include('SIGSAS.xFiles.Codes.__hoja_tree_view_one',['items'=>$item,"isborder"=>true])
                    @include('SIGSAS.xFiles.Codes.__hoja_tree_view',['items'=>$item->childs])
                @else
                    @include('SIGSAS.xFiles.Codes.__hoja_tree_view_one',['items'=>$item])
                @endif
            @endforeach
        </ul>
    </div>
</div>
