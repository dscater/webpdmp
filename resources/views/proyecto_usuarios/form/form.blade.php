<fieldset>
    @if (isset($proyecto))
        <legend><i class="fa fa-pen"></i> MODIFICAR INFORMACIÓN DE PROYECTO-USUARIO</legend>
    @else
        <legend><i class="fa fa-save"></i> NUEVO PROYECTO-USUARIO</legend>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Seleccionar Proyecto*</label>
                {{ Form::select('proyecto_id', $array_proyectos, null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Seleccionar Usuario*</label>
                {{ Form::select('user_id', $array_users, null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
    </div>
</fieldset>
