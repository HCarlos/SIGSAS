<div class="col-md-12 ">
    <div class="row">
    <div class="col-md-6 ">
        <div class="grid-container">
            @isset($item)
{{--                @include('SIGSAS.xFiles.UI_Kit.__button_form_close_denuncia')--}}
            @endisset
            @if($msgLeft)
                {{$msgLeft}}
            @else
                <p class="text-info ">No olvide revisar sus datos antes de guardar!</p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="grid-container">
            @include('SIGSAS.xFiles.UI_Kit.__button_form_denuncia')
        </div>
    </div>
</div>
</div>
