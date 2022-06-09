<div class="col-md-12">
<div class=" row">
    <div class="col-lg-6 ">
        <div class="grid-container">
            <div class="form-row mb-1">
                <label for = "search_autocomplete_user" class="col-lg-3 col-form-label labelDenuncia">Buscar Usuario</label>
                <div class="col-lg-12">
                    <div class="input-group btn-group-xs">
                        {!! Form::text('search_autocomplete_user', $items->Ciudadano->FullName, array('placeholder' => 'Buscar usuario...','class' => 'form-control','id'=>'search_autocomplete_user')) !!}
                        <span class="input-group-append">
                            <a href="{{route("newUser")}}" target="_blank" class="btn btn-info btn-info"> <i class="fa fa-user-plus"></i></a>
                        </span>
                    </div>
                    <div class="input-group btn-group-xs">
                    {!! Form::text('usuario', $items->Ciudadano->FullName, array('class' => 'form-control','id'=>'usuario','readonly'=>'readonly')) !!}
                        <span class="input-group-append">
                            <a  href="{{route("editUser",['Id'=>$items->Ciudadano->id])}}" target="_blank" class="btn btn-a-info btn-info editUser" id="editUser" name="editUser"> <i class="fa fa-user-edit"></i></a>
                        </span>
                    </div>
                    {!! Form::text('usuario_domicilio', $items->Ciudadano->ubicaciones->first()->Ubicacion, array('class' => 'form-control','id'=>'usuario_domicilio','readonly'=>'readonly')) !!}
                    {!! Form::text('usuario_telefonos', $items->Ciudadano->TelefonosCelularesEmails, array('class' => 'form-control','id'=>'usuario_telefonos','readonly'=>'readonly')) !!}
                </div>
            </div>

            <div class="form-row mb-1 " >
                <label class="col-lg-12 col-form-label labelDenuncia">Ubicación del Problema? </label>
                <div class="col-lg-12 mb-2">
                    <select id="pregunta1" name="pregunta1" class="form-control pregunta1" size="1">
                        <option value="0" {{$pregunta1 == 0 ? 'selected': '' }} >La misma ubicación del usuario demandante </option>
                        <option value="1" {{$pregunta1 == 1 ? 'selected': '' }} >Otra Ubicación </option>
                    </select>

                </div>
            </div>

            <div class="form-row panelUbiProblem pb-2" style="background-color: floralwhite">
                <label for = "search_autocomplete" class="col-lg-12 col-form-label">Buscar ubicación del Problema</label>
                <div class="col-lg-12">
                    <div class="input-group">
                        {!! Form::text('search_autocomplete',  $items->Ubicacion->Ubicacion, array('placeholder' => 'Buscar ubicación...','class' => 'form-control','id'=>'search_autocomplete')) !!}
                        <span class="input-group-append">
                            <a href="{{route("newUbicacion")}}" target="_blank" class="btn btn-icon btn-info"> <i class="fa fa-book-open"></i></a>
                        </span>
                    </div>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion', $items->Ubicacion->Ubicacion) }}" class="form-control" disabled/>
                </div>
            </div>
            <hr>
            <div class="form-row mb-1 ">
                <label for = "fecha_ingreso" class="col-lg-2 col-form-label">Fecha </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_ingreso', old('fecha_ingreso',$items->fecha_ingreso), ['id'=>'fecha_ingreso','class'=>'form-control']) }}
                </div>
                <label for = "fecha_oficio_dependencia" class="col-lg-2 col-form-label">F. Oficio </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_oficio_dependencia', old('fecha_oficio_dependencia',$items->fecha_oficio_dependencia), ['id'=>'fecha_oficio_dependencia','class'=>'form-control']) }}
                </div>
            </div>
            <div class="form-row mb-1">
                <label for = "fecha_ejecucion" class="col-lg-2 col-form-label">F. Ejec. </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_ejecucion', old('fecha_ejecucion',$items->fecha_ejecucion), ['id'=>'fecha_ejecucion','class'=>'form-control']) }}
                </div>
                <label for = "fecha_limite" class="col-lg-2 col-form-label">F. Límite </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_limite', old('fecha_limite',$items->fecha_limite), ['id'=>'fecha_limite','class'=>'form-control']) }}
                </div>
            </div>
            <hr>

        </div>
    </div>

    <div class="col-lg-6 ">

        <div class="grid-container">

            <div class="form-group row mb-1">
                <label for = "oficio_envio" class="col-lg-3 col-form-label">Oficio E. </label>
                <div class="col-lg-3">
                    <input type="text" name="oficio_envio" id="oficio_envio" value="{{ old('oficio_envio',$items->oficio_envio) }}" class="form-control" />
                </div>
                <label for = "folio_sas" class="col-lg-2 col-form-label">Folio SAS</label>
                <div class="col-lg-4">
                    <input type="text" name="folio_sas" id="folio_sas" value="{{ old('folio_sas',$items->folio_sas) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "descripcion" class="col-lg-3 col-form-label has-descripcion labelDenuncia">Denuncia </label>
                <div class="col-lg-9">
                    <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion',$items->descripcion) }}</textarea>
                    <span class="has-descripcion">
                        <strong class="text-danger"></strong>
                    </span>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "referencia" class="col-lg-3 col-form-label labelDenuncia">Referencia </label>
                <div class="col-lg-9">
                    <textarea name="referencia" id="referencia" class="form-control">{{ old('referencia',$items->referencia) }}</textarea>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "clave_identificadora" class="col-lg-3 col-form-label labelDenuncia">Cve Identific</label>
                <div class="col-lg-9">
                    <input type="text" name="clave_identificadora" id="clave_identificadora" value="{{ old('clave_identificadora',$items->clave_identificadora) }}"  class="form-control" />
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "prioridad_id" class="col-lg-3 col-form-label labelDenuncia">Prioridad</label>
                <div class="col-lg-2">
                    <select id="prioridad_id" name="prioridad_id" class="form-control" size="1">
                        @foreach($prioridades as $t)
                            <option value="{{$t->id}}" {{ $t->id == $items->prioridad_id ? 'selected': '' }} >{{ $t->prioridad }} </option>
                        @endforeach
                    </select>
                </div>
                <label for = "origen_id" class="col-lg-2 col-form-label labelDenuncia">Origen</label>
                <div class="col-lg-5">
                    <select id="origen_id" name="origen_id" class="form-control"size="1">
                        @foreach($origenes as $t)
                            <option value="{{$t->id}}" {{ $t->id == $items->origen_id ? 'selected': '' }} >{{ $t->origen }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "servicio_id" class="col-lg-3 col-form-label labelDenuncia">Servicio</label>
                <div class="col-lg-9">
                    <select id="servicio_id" name="servicio_id" class="form-control" size="1">
                        <option value="0" selected>Seleccione un Servicio</option>
                        @foreach($servicios as $t)
                            <option value="{{$t->id}}" {{ $t->id == $items->servicio_id ? 'selected': '' }} >{{ $t->servicio }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "estatus_id" class="col-lg-3 col-form-label labelDenuncia">Estatus</label>
                <div class="col-lg-9">
                    <select id="estatus_id" name="estatus_id" class="form-control" size="1">
                        @foreach($estatus as $t)
                            <option value="{{$t->id}}" {{ $t->id == $items->estatus_id ? 'selected': '' }} >{{ $t->estatus }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row mb-1">
                <label for = "observaciones" class="col-lg-3 col-form-label">Observaciones </label>
                <div class="col-lg-9">
                    <textarea name="observaciones" id="observaciones" class="form-control">{{ old('observaciones',$items->observaciones) }}</textarea>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<div class="grid-structure">
    <div class=" row">
        <div class="col-lg-12 ">
            <div class="grid-container">
                <div class="form-group mb-3">



                    <div class="table-responsive-sm">
                        <table class="table table-centered mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th>Imegen</th>
                                <th>Directorio</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items->imagenes as $item)
                            <tr>
                                <td>
                                    <a class="pull-left pl-2"  href="{{asset($item->PathImage)}}" target="_blank" >
                                        <img class="media-object" src="{{asset($item->PathImageThumb)}}" width="64" height="64" >
                                    </a>
                                </td>
                                <td>{{ asset("/storage/denuncia/" . $item->image) }}</td>
                                <td>
                                    @include('SIGSAS.xFiles.UI_Kit.__remove_item')
                                </td>
                            </tr>
                            @endforeach
                            @for($it=$items->imagenes->count()+1;$it<=3;$it++)
                                <tr>
                                    <td colspan="3">
                                        <div class="form-group mb-1">
                                            <label for="file{{$it}}"><strong>Archivo {{$it}}</strong>: Subir archivo</label>
                                            <input type="file" id="file{{$it}}" name="file{{$it}}" class="form-control-file">
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div>


                </div>
            </div>
        </div>
    </div>

<div class="row mt-4">
    <div class="col-sm-3">
        <h6>CREADO</h6>
        <address>
            <strong class="orange">POR:</strong>  {{ $items->creadopor->Fullname }}<br>
            <strong class="purple">FECHA:</strong>  {{ date('d-m-Y H:i:s', strtotime($items->created_at)) }}<br>
        </address>
    </div> <!-- end col-->
    <div class="col-sm-3">
        <h6>MODIFICADO</h6>
        <address>
            <strong class="orange">POR:</strong>  {{ $items->modificadopor->Fullname }}<br>
            <strong class="purple">FECHA:</strong>  {{ date('d-m-Y H:i:s', strtotime($items->updated_at)) }}<br>
        </address>
    </div> <!-- end col-->
    <div class="col-sm-6">
        <h6>ÚLTIMA RESPUESTA</h6>
        <address>
            <strong class="orange">POR:</strong>  {{ $items->dependencias->first()->dependencia }}<br>
            <strong class="seagreen">ESTATUS:</strong>  {{ $items->denuncia_estatus->first()->estatus }}<br>
            <strong class="red">FAVORABLE:</strong>  {{ $items->denuncia_estatus->first()->pivot->favorable == true ? 'SI' : 'NO' }}<br>
            <strong class="purple">FECHA:</strong>  {{ date('d-m-Y H:i:s', strtotime($items->denuncia_estatus->first()->pivot->fecha_movimiento)) }}<br>
            <strong class="coral">RESPUESTA:</strong> <small> {{ $items->denuncia_estatus->first()->pivot->observaciones }} </small><br>

        </address>
    </div> <!-- end col-->
</div>



<hr>

<input type="hidden" name="id" id="id" value="{{$items->id}}" >
<input type="hidden" name="ubicacion_id" id="ubicacion_id" value="{{$items->Ubicacion->id}}" >
<input type="hidden" name="creadopor_id" id="creadopor_id" value="{{$items->creadopor_id}}" >
<input type="hidden" name="modificadopor_id" id="modificadopor_id" value="{{$user->id}}" >
<input type="hidden" name="usuario_id" id="usuario_id" value="{{$items->Ciudadano->id}}" >
<input type="hidden" name="dependencia_id" id="dependencia_id" value="{{ config("sigsas.sas_id") }}" >
