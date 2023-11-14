<fieldset>
    @if (isset($maquinaria))
        <legend><i class="fa fa-pen"></i> MODIFICAR DATOS DEL EQUIPO/MAQUINARIA</legend>
    @else
        <legend><i class="fa fa-save"></i> NUEVO EQUIPO/MAQUINARIA</legend>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Código*</label>
                {{ Form::text('codigo', null, ['class' => 'form-control', 'required']) }}
                @if ($errors->has('codigo'))
                    <span class="invalid-feedback" style="color:rgb(247, 242, 0);display:block" role="alert">
                        <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Clase*</label>
                {{ Form::select('clase', ['' => 'Seleccione...', 'EQUIPO' => 'EQUIPO', 'MAQUINARIA' => 'MAQUINARIA'], null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Serie</label>
                {{ Form::text('serie', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Chasis</label>
                {{ Form::text('chasis', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Matrícula</label>
                {{ Form::text('matricula', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Marca</label>
                {{ Form::text('marca', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Modelo</label>
                {{ Form::text('modelo', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Color</label>
                {{ Form::text('color', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Año</label>
                {{ Form::text('anio', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Tracción</label>
                {{ Form::text('traccion', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Documento</label>
                {{ Form::text('documento', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Certificado</label>
                {{ Form::text('certificado', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Chasis</label>
                {{ Form::text('chasis', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>DUI</label>
                {{ Form::text('dui', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>FRM</label>
                {{ Form::text('frm', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Horómetro</label>
                {{ Form::text('horometro', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Kilometraje</label>
                {{ Form::text('kilometraje', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Estado</label>
                {{ Form::text('estado', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Observaciones</label>
                {{ Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '2']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Combustible</label>
                {{ Form::select('combustible', ['' => 'Ninguno', 'DIESEL' => 'DIESEL', 'GASOLINA' => 'GASOLINA'], null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Tipo*</label>
                {{ Form::select('tipo', ['' => 'Seleccione...', 'RETROEXCAVADORAS' => 'RETROEXCAVADORAS', 'PALAS' => 'PALAS', 'MARTILLO' => 'MARTILLO', 'EXCAVADORA' => 'EXCAVADORA', 'VIBRO COMPACTADORA' => 'VIBRO COMPACTADORA', 'TOPADORA' => 'TOPADORA', 'MOTONIVELADORA' => 'MOTONIVELADORA', 'CAMION' => 'CAMION', 'COMPRESORAS' => 'COMPRESORAS', 'GENERADOR ELÉCTRICO' => 'GENERADOR ELÉCTRICO', 'CAMIONETAS' => 'CAMIONETAS', 'MINIBUSES' => 'MINIBUSES', 'VOLQUETAS' => 'VOLQUETAS', 'SIN DOCUMENTOS' => 'SIN DOCUMENTOS', 'VARIOS' => 'VARIOS'], null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Propiedad*</label>
                {{ Form::select('propiedad', ['' => 'Seleccione...', 'PROPIO' => 'PROPIO', 'ALQUILER' => 'ALQUILER'], null, ['class' => 'form-control', 'required', 'id' => 'propiedad']) }}
            </div>
        </div>
        <div
            class="col-md-4 {{ isset($maquinaria) ? ($maquinaria->propiedad == 'PROPIO' ? 'oculto' : '') : 'oculto' }}">
            <div class="form-group">
                <label>Costo por Hora*</label>
                {{ Form::number('costo', null, ['class' => 'form-control', 'step' => '0.01', 'id' => 'costo_alquiler']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Encargado/Contratante*</label>
                {{ Form::text('encargado', null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Seleccionar Usuario Operador*</label>
                {{ Form::select('user_id', $array_users, null, ['class' => 'form-control', 'required']) }}
                @if ($errors->has('user_id'))
                    <span class="invalid-feedback" style="color:rgb(247, 242, 0);display:block" role="alert">
                        <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Foto</label>
                {{ Form::file('foto', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</fieldset>
