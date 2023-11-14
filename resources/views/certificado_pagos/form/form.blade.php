<fieldset>
    @if (isset($certificado_pago))
        <legend><i class="fa fa-pen"></i> MODIFICAR INFORMACIÓN DE CERTIFICADO DE PAGO</legend>
    @else
        <legend><i class="fa fa-save"></i> NUEVO CERTIFICADO DE PAGO</legend>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Equipo/Maquinaria*</label>
                {{ Form::select('maquinaria_id', $array_maquinarias, null, ['class' => 'form-control', 'id' => 'maquinaria_id']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Mes*</label>
                {{ Form::select('mes', $array_meses, null, ['class' => 'form-control', 'id' => 'mes']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Año*</label>
                {{ Form::select('anio', $array_anios, null, ['class' => 'form-control', 'id' => 'anio']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="contenedorDatos">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" id="btnAgregarFila1" class="btn btn-primary btn-sm mb-2" style="width:100%;"><i class="fa fa-plus"></i> AGREGAR FILA</button>
        </div>
        <div class="col-md-12">
            <table class="tabla_pagos" border="1">
                <thead>
                    <tr class="bg-yellow">
                        <th>N°</th>
                        <th>FECHA</th>
                        <th>DETALLE</th>
                        <th>UNIDAD</th>
                        <th>CANTIDAD</th>
                        <th>P/U Bs.</th>
                        <th>TOTAL Bs.</th>
                        <th></th>
                    </tr>
                </thead>
                @php
                    $total1 = 0;
                @endphp
                <tbody class="bg-white" id="contenedorFilas1">
                    <tr class="vacio">
                        <td colspan="8" class="text-center">NO SE AGREGARÓN FILAS</td>
                    </tr>
                </tbody>
                <tfoot id="total1">
                    <tr class="bg-yellow">
                        <th colspan="6" class="text-right" style="padding-right: 5px;">TOTAL Bs.</th>
                        <th><span>{{ number_format($total1, 2, '.', ',') }}</span><input type="hidden" name="total" value="{{number_format($total1, 2, '.', ',')}}"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12">
            <h4 class="text-center">MENOS</h4>
        </div>
        <div class="col-md-12">
            <button type="button" id="btnAgregarFila2" class="btn btn-primary btn-sm mb-2" style="width:100%;"><i class="fa fa-plus"></i> AGREGAR FILA</button>
        </div>
        <div class="col-md-12">
            <table class="tabla_pagos" border="1">
                <thead>
                    <tr class="bg-yellow">
                        <th>N°</th>
                        <th>FECHA</th>
                        <th>DETALLE</th>
                        <th>UNIDAD</th>
                        <th>CANTIDAD</th>
                        <th>P/U Bs.</th>
                        <th>TOTAL Bs.</th>
                        <th></th>
                    </tr>
                </thead>
                @php
                    $total2 = 0;
                @endphp
                <tbody class="bg-white" id="contenedorFilas2">
                    <tr class="vacio">
                        <td colspan="8" class="text-center">NO SE AGREGARÓN FILAS</td>
                    </tr>
                </tbody>
                <tfoot id="total2">
                    <tr class="bg-yellow">
                        <th colspan="6" class="text-right" style="padding-right: 5px;">TOTAL Bs.</th>
                        <th><span>{{ number_format($total2, 2, '.', ',') }}</span><input type="hidden" name="descuento" value="{{number_format($total2, 2, '.', ',')}}"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        @php
            $liquido_pagable = $total1 - $total2;
        @endphp
        <div class="col-md-12 mt-3">
            <table class="tabla_pagos">
                <tbody id="liquido_pagable">
                    <tr class="bg-yellow">
                        <th colspan="6" class="text-right" style="padding-right: 5px;">LIQUIDO PAGABLE</th>
                        <th><span>{{ number_format($liquido_pagable, 2, '.', ',') }}</span> <input type="hidden" name="total_pagable" value="{{ number_format($liquido_pagable, 2, '.', ',')}}"></th>
                    </tr>
                    <tr class="bg-yellow">
                        <th colspan="7"><span>-</span><input type="hidden" name="literal"></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="oculto" id="eliminaExistentes1"></div>
        <div class="oculto" id="eliminaExistentes2"></div>
    </div>
</fieldset>
