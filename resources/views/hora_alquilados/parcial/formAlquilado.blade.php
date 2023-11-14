@if (isset($hora_alquilado))
    {!! Form::model($hora_alquilado, [
        'route' => ['hora_alquilados.update', $hora_alquilado->id],
        'method' => 'post',
        'id' => 'formularioRegistroHora',
    ]) !!}
    <input type="hidden" id="urlEliminarFormulario" value={{ route('hora_alquilados.destroy', $hora_alquilado->id) }}>
    <div class="row">
        <div class="col-md-12">
            <h3 class="font-weight-bold bg-yellow titulo_formulario">MODIFICAR REGISTRO <button type="button"
                    class="close cierra_formulario" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button></h3>
        </div>
    </div>
@else
    {!! Form::open(['route' => 'hora_alquilados.store', 'method' => 'post', 'id' => 'formularioRegistroHora']) !!}
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
            @if (isset($hora_alquilado))
                <label class="text-white">Día ({{ $array_meses[$hora_alquilado->mes] }})*</label>
            @else
                <input type="hidden" name="mes" value={{ $mes }}>
                <input type="hidden" name="anio" value={{ $anio }}>
                <label class="text-white">Día ({{ $array_meses[$mes] }})*</label>
            @endif
            {{ Form::select('dia', $array_dias, isset($hora_alquilado) ? null : (int) date('d'), ['class' => 'form-control dia_select', 'required']) }}
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
            <label class="text-white">Horas Calentamiento</label>
            {{ Form::text('calentamiento', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Horas Acumuladas</label>
            {{ Form::number('acumuladas', null, ['class' => 'form-control', 'step' => '0.01']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Total Horas</label>
            {{ Form::number('total_horas', null, ['class' => 'form-control', 'step' => '0.01']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-white">Días Trabajados</label>
            {{ Form::number('dias_trabajados', null, ['class' => 'form-control', 'step' => '0.01']) }}
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
                    <td>Aceite Litros-15W40[D]</td>
                    <td>{{ Form::number('aceite1', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_aceite1', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td> Aceites Litros-H68[HIDRA.]</td>
                    <td>{{ Form::number('aceite2', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_aceite2', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
                <tr>
                    <td>Líquido Hidráulico</td>
                    <td>{{ Form::number('liquidoh', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_liquidoh', null, ['class' => 'form-control', 'step' => '0.01']) }}
                    </td>
                </tr>
                <tr>
                    <td> Grasa [Kg]</td>
                    <td>{{ Form::number('grasa', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_grasa', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
                <tr>
                    <td>Filtros</td>
                    <td>{{ Form::number('filtro', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                    <td>{{ Form::number('costo_filtro', null, ['class' => 'form-control', 'step' => '0.01']) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="text-white">Nro. de Viajes</label>
            {{ Form::number('num_viajes', null, ['class' => 'form-control', 'step' => '0.01']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="text-white">Observaciones</label>
            {{ Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '2']) }}
        </div>
    </div>
    <div class="col-md-12">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
        @if (isset($hora_alquilado))
            @if (!$sw_entrega)
                <button type="button" class="btn bg-yellow float-right ml-1"
                    id="btnActualizaFormulario">Actualizar</button>
                <button type="button" class="btn btn-success float-right ml-1"
                    id="btnEntregaRegistro">Entregar</button>
                <button type="button" class="btn btn-danger float-right ml-1"
                    id="btnEliminaFormulario">Eliminar</button>
            @endif
            <a href="{{ route('hora_alquilados.trayecto_gps') }}" class="btn bg-black float-right">Trayecto GPS<a>
                @else
                    <button type="button" class="btn bg-yellow float-right"
                        id="btnRegistraFormulario">Registrar</button>
        @endif
    </div>
</div>
{!! Form::close() !!}
