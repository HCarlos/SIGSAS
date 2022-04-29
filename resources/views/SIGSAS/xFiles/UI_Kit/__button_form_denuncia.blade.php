@isset($item)
    @if($item->cerrado==false )
        <button type="submit" class="btn btn-lg btn-rounded btn-primary float-right">
            <i class="fas fa-check-circle"></i> Guardar
        </button>
    @endif
@else
    <button type="submit" class="btn btn-lg btn-rounded btn-primary float-right">
        <i class="fas fa-check-circle"></i> Guardar
    </button>
@endisset
