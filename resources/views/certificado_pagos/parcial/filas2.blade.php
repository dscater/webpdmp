@foreach ($certificado_pago->detalle_restas as $value)
    <tr class="fila existe f2" data-id="{{$value->id}}" data-elimina="{{route('certificado_detalle_restas.destroy',$value->id)}}">
        <td><span>#</span><input type="hidden" value="{{$value->id}}" name="id_existentes2[]"/></td>
        <td><input type="date" name="fecha2{{$value->id}}" value="{{$value->fecha}}" class="form-control" required></td>
        <td><input type="text" name="detalle2{{$value->id}}" value="{{$value->detalle}}" class="form-control" required></td>
        <td><input type="text" name="unidad2{{$value->id}}" value="{{$value->unidad}}" class="form-control" required></td>
        <td><input type="number" step="0.01" name="cantidad2{{$value->id}}" value="{{$value->cantidad}}" class="form-control" required></td>
        <td><input type="number" step="0.01" name="pu2{{$value->id}}" value="{{$value->pu}}" class="form-control" required></td>
        <td><span>{{$value->total}}</span><input type="hidden" name="total2{{$value->id}}" value="{{$value->total}}" class="form-control" required></td>
        <td class="btn-opciones"><span><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i> Quitar</span></td>
    </tr>
@endforeach
