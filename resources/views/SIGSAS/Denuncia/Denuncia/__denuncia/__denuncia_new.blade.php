<div class="grid-structure">
<div class=" row">
    <div class="col-lg-6 ">
        <div class="grid-container">
            <div class="form-row mb-1">
                <label for = "search_autocomplete_user" class="col-lg-3 col-form-label labelDenuncia">Buscar Usuario</label>
                <div class="col-lg-12">
                    <div class="input-group">
                        {!! Form::text('search_autocomplete_user', null, array('placeholder' => 'Buscar usuario...','class' => 'form-control','id'=>'search_autocomplete_user')) !!}
                        <span class="input-group-append">
                            <a href="{{route("newUser")}}" target="_blank" class="btn btn-icon btn-info"> <i class="mdi mdi-plus"></i></a>
                        </span>
                    </div>
                    <div class="input-group btn-group-xs">
                        {!! Form::text('usuario', null, array('class' => 'form-control','id'=>'usuario','readonly'=>'readonly')) !!}
                        <span class="input-group-append">
                            <a  target="_blank" class="btn btn-xs btn-icon btn-primary editUser" id="editUser" name="editUser"> <i class="mdi mdi-account-edit  text-white"></i></a>
                        </span>
                    </div>

                    {!! Form::text('usuario_domicilio', null, array('class' => 'form-control','id'=>'usuario_domicilio','readonly'=>'readonly')) !!}
                    {!! Form::text('usuario_telefonos', null, array('class' => 'form-control','id'=>'usuario_telefonos','readonly'=>'readonly')) !!}
                </div>
            </div>

            <div class="form-row mb-1 " >
                <label class="col-lg-12 col-form-label labelDenuncia">Ubicación del Problema? </label>
                <div class="col-lg-8 mb-2">
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="radio1" name="pregunta1" class="custom-control-input pregunta1" value="0">
                        <label class="custom-control-label" for="radio1">La misma ubicación del usuario demandante</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio2" name="pregunta1" class="custom-control-input pregunta1" value="1">
                        <label class="custom-control-label" for="radio2">Otra Ubicación</label>
                    </div>
                </div>
            </div>

            <div class="form-row panelUbiProblem pb-2" style="background-color: floralwhite">
                <label for = "search_autocomplete" class="col-lg-12 col-form-label">Buscar ubicación del Problema</label>
                <div class="col-lg-12">
                    <div class="input-group">
                        {!! Form::text('search_autocomplete', null, array('placeholder' => 'Buscar ubicación...','class' => 'form-control search_autocomplete','id'=>'search_autocomplete')) !!}
                        <span class="input-group-append">
                            <a href="{{route("newUbicacion")}}" target="_blank" class="btn btn-icon btn-info"> <i class="mdi mdi-plus"></i></a>
                        </span>
                    </div>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}" class="form-control" disabled/>
                </div>
            </div>
            <hr>
            <div class="form-row mb-1 ">
                <label for = "fecha_ingreso" class="col-lg-2 col-form-label">Fecha </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_ingreso', \Carbon\Carbon::now(), ['id'=>'fecha_ingreso','class'=>'form-control']) }}
                </div>
                <label for = "fecha_oficio_dependencia" class="col-lg-2 col-form-label">F. Oficio </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_oficio_dependencia', \Carbon\Carbon::now(), ['id'=>'fecha_oficio_dependencia','class'=>'form-control']) }}
                </div>
            </div>
            <div class="form-row mb-1">
                <label for = "fecha_ejecucion" class="col-lg-2 col-form-label">F. Ejec. </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_ejecucion', \Carbon\Carbon::now()->addDay(3), ['id'=>'fecha_ejecucion','class'=>'form-control']) }}
                </div>
                <label for = "fecha_limite" class="col-lg-2 col-form-label">F. Límite </label>
                <div class="col-lg-4">
                    {{ Form::date('fecha_limite', \Carbon\Carbon::now()->addDay(5), ['id'=>'fecha_limite','class'=>'form-control']) }}
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
                    <input type="text" name="oficio_envio" id="oficio_envio" value="{{ old('oficio_envio') }}" class="form-control" />
                </div>
                <label for = "folio_sas" class="col-lg-2 col-form-label">Folio SAS</label>
                <div class="col-lg-4">
                    <input type="text" name="folio_sas" id="folio_sas" value="{{ old('folio_sas') }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "descripcion" class="col-lg-3 col-form-label has-descripcion labelDenuncia">Denuncia </label>
                <div class="col-lg-9">
                    <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                    <span class="has-descripcion">
                        <strong class="text-danger"></strong>
                    </span>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "referencia" class="col-lg-3 col-form-label labelDenuncia">Referencia </label>
                <div class="col-lg-9">
                    <textarea name="referencia" id="referencia" class="form-control">{{ old('referencia') }}</textarea>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "clave_identificadora" class="col-lg-3 col-form-label labelDenuncia">Cve Identific</label>
                <div class="col-lg-9">
                    <input type="text" name="clave_identificadora" id="clave_identificadora" value="{{ old('clave_identificadora') }}"  class="form-control" />
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "prioridad_id" class="col-lg-3 col-form-label labelDenuncia">Prioridad</label>
                <div class="col-lg-2">
                    <select id="prioridad_id" name="prioridad_id" class="form-control" size="1">
                        @foreach($prioridades as $t)
                            <option value="{{$t->id}}" {{ $t->isDefault() ? 'selected': '' }} >{{ $t->prioridad }} </option>
                        @endforeach
                    </select>
                </div>
                <label for = "origen_id" class="col-lg-2 col-form-label labelDenuncia">Origen</label>
                <div class="col-lg-5">
                    <select id="origen_id" name="origen_id" class="form-control"size="1">
                        @foreach($origenes as $t)
                            <option value="{{$t->id}}" {{ $t->isDefault() ? 'selected': '' }} >{{ $t->origen }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "dependencia_id" class="col-lg-3 col-form-label labelDenuncia">Dependencia</label>
                <div class="col-lg-9">
                    <select id="dependencia_id" name="dependencia_id" class="form-control" size="1">
                        <option value="0" selected>Seleccione una Dependencia</option>
                        @foreach($dependencias as $t)
                            <option value="{{$t->id}}" >{{ old('dependencia_id',$t->dependencia) }} </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "servicio_id" class="col-lg-3 col-form-label labelDenuncia">Servicio</label>
                <div class="col-lg-9">
                    <select id="servicio_id" name="servicio_id" class="form-control" size="1" value="{{ old( 'servicio') }}">
                    </select>
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for = "estatus_id" class="col-lg-3 col-form-label labelDenuncia">Estatus</label>
                <div class="col-lg-9">
                    <select id="estatus_id" name="estatus_id" class="form-control" size="1">
                        @foreach($estatus as $t)
                            <option value="{{$t->id}}" {{ $t->isDefault() ? 'selected': '' }} >{{ $t->estatus }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row mb-1">
                <label for = "observaciones" class="col-lg-3 col-form-label">Observaciones </label>
                <div class="col-lg-9">
                    <textarea name="observaciones" id="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
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
                <div class="form-group mb-1">
                    <label for="file1"><strong>Archivo 1</strong>: Subir archivo</label>
                    <input type="file" id="file1" name="file1" class="form-control-file">
                </div>
                <hr>
                <div class="form-group mb-1">
                    <label for="file2"><strong>Archivo 2</strong>: Subir archivo</label>
                    <input type="file" id="file2" name="file2" class="form-control-file">
                </div>
                <hr>
                <div class="form-group mb-1">
                    <label for="file3"><strong>Archivo 3</strong>: Subir archivo</label>
                    <input type="file" id="file3" name="file3" class="form-control-file">
                </div>
            </div>
        </div>
    </div>
</div>


<hr>

<input type="hidden" name="id" value="0" >
<input type="hidden" name="ubicacion_id" id="ubicacion_id" value="0" >
<input type="hidden" name="creadopor_id" id="creadopor_id" value="{{$user->id}}" >
<input type="hidden" name="modificadopor_id" id="modificadopor_id" value="{{$user->id}}" >
<input type="hidden" name="usuario_id" id="usuario_id" value="0" >
