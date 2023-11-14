@foreach ($certificado_pago->detalles as $value)
    <tr class="fila existe f1" data-id="{{$value->id}}" data-elimina="{{route('certificado_detalles.destroy',$value->id)}}">
        <td><span>#</span><input type="hidden" value="{{$value->id}}" name="id_existentes1[]"/></td>
        <td><input type="date" name="fecha1{{$value->id}}" value="{{$value->fecha}}" class="form-control" required></td>
        <td><input type="text" name="detalle1{{$value->id}}" value="{{$value->detalle}}" class="form-control" required></td>
        <td><input type="text" name="unidad1{{$value->id}}" value="{{$value->unidad}}" class="form-control" required></td>
        <td><input type="number" step="0.01" name="cantidad1{{$value->id}}" value="{{$value->cantidad}}" class="form-control" required></td>
        <td><input type="number" step="0.01" name="pu1{{$value->id}}" value="{{$value->pu}}" class="form-control" required></td>
        <td><span>{{$value->total}}</span><input type="hidden" name="total1{{$value->id}}" value="{{$value->total}}" class="form-control" required></td>
        <td class="btn-opciones"><span><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i> Quitar</span></td>
    </tr>
@endforeach
