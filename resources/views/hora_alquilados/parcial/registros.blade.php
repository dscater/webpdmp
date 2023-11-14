<div class="row">
    <div class="col-lg-12 mb-2">
        <a href="{{ route('hora_alquilados.pdf') }}?anio_mes={{ $anio_mes }}&maquinaria_id={{ $maquinaria->id }}"
            class="btn bg-yellow" target="_blank"><i class="fa fa-file-pdf"></i> EXPORTAR</a>
    </div>
    <div class="col-lg-12">
        <table class="tabla_registros">
            <thead class="bg-yellow">
                <tr>
                    <th rowspan="2" colspan="2">Día-Fecha</th>
                    <th colspan="2">Horometro</th>
                    <th rowspan="2">Hras. Trabajadas</th>
                    <th rowspan="2">Hras. Calentamiento</th>
                    <th rowspan="2">Hras. Acumuladas</th>
                    <th rowspan="2">Total Hras. Trabajadas</th>
                    <th colspan="3">Combustible Lts.</th>
                    <th colspan="4">Aceites(Litros)</th>
                    <th rowspan="2">Liquido hidraulico</th>
                    <th rowspan="2">Costo</th>
                    <th rowspan="2">Grasa [kg]</th>
                    <th rowspan="2">Costo</th>
                    <th rowspan="2">Filtros</th>
                    <th rowspan="2">Costo</th>
                    <th rowspan="2">Nro. Viajes</th>
                    <th rowspan="2">Observaciones</th>
                </tr>
                <tr>
                    <th>Inicial</th>
                    <th>Final</th>
                    <th>Diesel</th>
                    <th>Gasolina</th>
                    <th>Costo</th>
                    <th>15W40[D]</th>
                    <th>Costo</th>
                    <th>H68 [HID RA.]</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody class="bg-white text-black">
                @php
                    // INICIALIZACIÓN DE TOTALES
                    $t_horometro_ini = '';
                    $t_horometro_fin = '';
                    $t_horas_trabajadas = 0;
                    $t_calentamiento = 0;
                    $t_acumuladas = 0;
                    $t_total_horas = 0;
                    $t_diesel = 0;
                    $t_gasolina = 0;
                    $t_costo_combustible = 0;
                    $t_aceite1 = 0;
                    $t_costo_aceite1 = 0;
                    $t_aceite2 = 0;
                    $t_costo_aceite2 = 0;
                    $t_liquidoh = 0;
                    $t_costo_liquidoh = 0;
                    $t_grasa = 0;
                    $t_costo_grasa = 0;
                    $t_filtro = 0;
                    $t_costo_filtro = 0;
                    $t_num_viajes = 0;
                @endphp
                @for ($i = 1; $i <= (int) $dias; $i++)
                    @php
                        $dia = $i;
                        if ($i < 10) {
                            $dia = '0' . $i;
                        }
                        $fecha = $anio_mes . '-' . $dia;
                    @endphp
                    <tr data-id="{{ isset($registros[$fecha]) ? $registros[$fecha]->id : '' }}">
                        <td>{{ $array_dias_txt[date('w', strtotime($fecha))] }}</td>
                        <td>{{ $i }}</td>
                        @if (isset($registros[$fecha]))
                            @php
                                if ($t_horometro_ini == '') {
                                    $t_horometro_ini = $registros[$fecha]->horometro_ini;
                                }
                                if ($registros[$fecha]->horometro_fin != '') {
                                    $t_horometro_fin = $registros[$fecha]->horometro_fin;
                                }
                                if ($registros[$fecha]->horometro_fin > 0) {
                                    $t_acumuladas = $registros[$fecha]->acumuladas;
                                }
                                $t_horas_trabajadas += $registros[$fecha]->horas_trabajadas;
                                $t_calentamiento += $registros[$fecha]->calentamiento;
                                $t_total_horas += $registros[$fecha]->total_horas;
                                
                                if ($registros[$fecha]->maquinaria->combustible == 'DIESEL') {
                                    $t_diesel += $registros[$fecha]->costo_combustible;
                                } else {
                                    $t_gasolina += $registros[$fecha]->costo_combustible;
                                }
                                $t_costo_combustible += $registros[$fecha]->costo_combustible;
                                $t_aceite1 += $registros[$fecha]->aceite1;
                                $t_costo_aceite1 += $registros[$fecha]->costo_aceite1;
                                $t_aceite2 += $registros[$fecha]->aceite2;
                                $t_costo_aceite2 += $registros[$fecha]->costo_aceite2;
                                $t_liquidoh += $registros[$fecha]->liquidoh;
                                $t_costo_liquidoh += $registros[$fecha]->costo_liquidoh;
                                $t_grasa += $registros[$fecha]->grasa;
                                $t_costo_grasa += $registros[$fecha]->costo_grasa;
                                $t_filtro += $registros[$fecha]->filtro;
                                $t_costo_filtro += $registros[$fecha]->costo_filtro;
                                $t_num_viajes += $registros[$fecha]->num_viajes;
                            @endphp

                            <td>{{ $registros[$fecha]->horometro_ini }}</td>
                            <td>{{ $registros[$fecha]->horometro_fin }}</td>
                            <td>{{ $registros[$fecha]->horas_trabajadas }}</td>
                            <td>{{ $registros[$fecha]->calentamiento }}</td>
                            <td>{{ $registros[$fecha]->acumuladas }}</td>
                            <td>{{ $registros[$fecha]->total_horas }}</td>
                            @if ($registros[$fecha]->combustible == 'DIESEL')
                                <td>{{ $registros[$fecha]->combustible_cantidad }}</td>
                                <td></td>
                            @else
                                <td></td>
                                <td>{{ $registros[$fecha]->combustible_cantidad }}</td>
                            @endif
                            <td>{{ $registros[$fecha]->costo_combustible }}</td>
                            <td>{{ $registros[$fecha]->aceite1 }}</td>
                            <td>{{ $registros[$fecha]->costo_aceite1 }}</td>
                            <td>{{ $registros[$fecha]->aceite2 }}</td>
                            <td>{{ $registros[$fecha]->costo_aceite2 }}</td>
                            <td>{{ $registros[$fecha]->liquidoh }}</td>
                            <td>{{ $registros[$fecha]->costo_liquidoh }}</td>
                            <td>{{ $registros[$fecha]->grasa }}</td>
                            <td>{{ $registros[$fecha]->costo_grasa }}</td>
                            <td>{{ $registros[$fecha]->filtro }}</td>
                            <td>{{ $registros[$fecha]->costo_filtro }}</td>
                            <td>{{ $registros[$fecha]->num_viajes }}</td>
                            <td>{{ $registros[$fecha]->observaciones }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @endfor
            </tbody>
            <tfoot class="bg-yellow">
                <tr>
                    <th colspan="2">TOTALES</th>
                    <th>{{ $t_horometro_ini }}</th>
                    <th>{{ $t_horometro_fin }}</th>
                    <th>{{ $t_horas_trabajadas }}</th>
                    <th>{{ $t_calentamiento }}</th>
                    <th>{{ $t_acumuladas }}</th>
                    <th>{{ $t_total_horas }}</th>
                    <th>{{ $t_diesel }}</th>
                    <th>{{ $t_gasolina }}</th>
                    <th>{{ number_format($t_costo_combustible, 2, '.', ',') }}</th>
                    <th>{{ $t_aceite1 }}</th>
                    <th>{{ number_format($t_costo_aceite1, 2, '.', ',') }}</th>
                    <th>{{ $t_aceite2 }}</th>
                    <th>{{ number_format($t_costo_aceite2, 2, '.', ',') }}</th>
                    <th>{{ $t_liquidoh }}</th>
                    <th>{{ number_format($t_costo_liquidoh, 2, '.', ',') }}</th>
                    <th>{{ $t_grasa }}</th>
                    <th>{{ number_format($t_costo_grasa, 2, '.', ',') }}</th>
                    <th>{{ $t_filtro }}</th>
                    <th>{{ number_format($t_costo_filtro, 2, '.', ',') }}</th>
                    <th>{{ $t_num_viajes }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
