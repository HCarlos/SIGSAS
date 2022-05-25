
<ul class="media-list ">
    @foreach($items as $item)
        <li class="media row mb-2 mt-2 p-2  bg-item-treview-inside " >
{{--            <a class="pull-left pl-2" href="#">--}}
{{--                <img class="media-object" src="{{ $item->user->PathImageThumbProfile }}?timestamp='{{ now() }}' " width="40" height="40" />--}}
{{--            </a>--}}
            <a class="pull-left pl-2"  href="{{asset($item->PathImage)}}" target="_blank" >
                <img class="media-object" src="{{asset($item->PathImageThumb)}}" width="64" height="64" >
            </a>
            <div class=" pl-2 col-md-12">
                <h4 class="media-heading">{{$item->titulo}} <small>{{$item->fecha}}</small>
                    <span class=" table-action button-list pl-2 ">
                        @include('SIGSAS.xFiles.UI_Kit.__edit_item_modal')
                        @include('SIGSAS.xFiles.UI_Kit.__remove_item')
                        @include('SIGSAS.xFiles.UI_Kit.__imagen_a_imagen_item')
                    </span>
                </h4>
                <div class="row ">
                    <div>
                        <div class="col-md-12">
                                {{$item->descripcion}}<br>
                                <small>{{$item->momento}}</small>
                            @if(count($item->childs))
                                @include('SIGSAS.xFiles.Codes.__hoja_tree_image',['items'=>$item->childs])
                            @endif
                        </div>
                        <div class="col-md-12"></div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>

