<fieldset>
    @if (isset($proyecto))
        <legend><i class="fa fa-pen"></i> MODIFICAR INFORMACIÓN DE PROYECTO</legend>
    @else
        <legend><i class="fa fa-save"></i> NUEVO PROYECTO</legend>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Nombre*</label>
                {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Lugar*</label>
                {{ Form::text('lugar', null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Fecha inicio</label>
                {{ Form::date('fecha_ini', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Fecha conclusión</label>
                {{ Form::date('fecha_fin', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</fieldset>
