@if (isset($hora_propio))
    {!! Form::model($hora_propio, [
        'route' => ['hora_propios.update', $hora_propio->id],
        'method' => 'post',
        'id' => 'formularioRegistroHora',
    ]) !!}
    <input type="hidden" id="urlEliminarFormulario" value={{ route('hora_propios.destroy', $hora_propio->id) }}>
    <div class="row">
        <div class="col-md-12">
            <h3 class="font-weight-bold bg-yellow titulo_formulario">MODIFICAR REGISTRO <button type="button"
                    class="close cierra_formulario" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button></h3>
        </div>
    </div>
@else
    {!! Form::open(['route' => 'hora_propios.store', 'method' => 'post', 'id' => 'formularioRegistroHora']) !!}
    <div class="row">
        <div class="col-md-12">
            <h3 class="font-weight-bold bg-yellow titulo_formulario">NUEVO REGISTRO <button type="button"
                    class="close cierra_formulario" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button></h3>
        </div>
    </div>
@endif
<input type="hidden" name="maquinaria_id" value={{ $maquinaria_id }}>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @if (isset($hora_propio))
                <label class="text-white">Día ({{ $array_meses[$hora_propio->mes] }})*</label>
            @else
                <input type="hidden" name="mes" value={{ $mes }}>
                <input type="hidden" name="anio" value={{ $anio }}>
                <label class="text-white">Día ({{ $array_meses[$mes] }})*</label>
            @endif
            {{ Form::select('dia', $array_dias, isset($hora_propio) ? null : (int) date('d'), ['class' => 'form-control dia_select', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Horómetro-Inicial</label>
            {{ Form::text('horometro_ini', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Horómetro-Final</label>
            {{ Form::text('horometro_fin', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Horas Trabajadas</label>
            {{ Form::text('horas_trabajadas', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Acumuladas</label>
            {{ Form::number('acumuladas', null, ['class' => 'form-control', 'step' => '0.01']) }}
        </div>
    </div>
    <div class="col-md-12">
        <table class="tabla_formulario" border="1">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Costo Bs.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Combustible Lts.</td>
                    <td>{{ Form::number('combustible_cantidad', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                    <td>{{ Form::number('costo_combustible', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
                <tr>
                    <td>Aceite de Motor</td>
                    <td>{{ Form::number('aceite', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_aceite', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td>Líquido Hidráulico</td>
                    <td>{{ Form::number('liquidoh', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_liquidoh', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
                <tr>
                    <td>Líquido de Transmisión</td>
                    <td>{{ Form::number('liquidot', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_liquidot', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
                <tr>
                    <td>Líquido de Frenos</td>
                    <td>{{ Form::number('liquidof', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_liquidof', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
                <tr>
                    <td>Grasa Kg</td>
                    <td>{{ Form::number('grasa', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_grasa', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td>Cambio Filtro-Aceite</td>
                    <td>{{ Form::number('filtroa', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_filtroa', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td>Cambio Filtro-Combustible</td>
                    <td>{{ Form::number('filtroc', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_filtroc', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td>Cambio Filtro Hidráulico</td>
                    <td>{{ Form::number('filtroh', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_filtroh', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td>Cambio Filtro-Aire</td>
                    <td>{{ Form::number('filtroaire', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_filtroaire', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="text-white">Observaciones</label>
            {{ Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '2']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="text-white">Reparaciones-Pieza Dañada</label>
            {{ Form::textarea('pieza_daniada', null, ['class' => 'form-control', 'rows' => '2']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="text-white">Reparaciones-Tiempo de reparación</label>
            {{ Form::text('tiempo_reparacion', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="text-white">Reparaciones-Estado de Pieza Reemplazo</label>
            {{ Form::textarea('estado_pieza', null, ['class' => 'form-control', 'rows' => '2']) }}
        </div>
    </div>
    <div class="col-md-12">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
        @if (isset($hora_propio))
            @if (!$sw_entrega)
                <button type="button" class="btn bg-yellow float-right ml-1"
                    id="btnActualizaFormulario">Actualizar</button>
                <button type="button" class="btn btn-success float-right ml-1"
                    id="btnEntregaRegistro">Entregar</button>
                <button type="button" class="btn btn-danger float-right ml-1"
                    id="btnEliminaFormulario">Eliminar</button>
            @endif
            <a href="{{ route('hora_propios.trayecto_gps') }}" class="btn bg-black float-right">Trayecto GPS<a>
                @else
                    <button type="button" class="btn bg-yellow float-right"
                        id="btnRegistraFormulario">Registrar</button>
        @endif
    </div>
</div>
{!! Form::close() !!}
