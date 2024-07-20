@if (count($maquinarias) > 0)
    @foreach ($maquinarias as $value)
        <div class="col-md-2">
            <div class="card bg-principal text-white">
                <div class="card-body">
                    <div class="contenedor_cliente">
                        <div class="opciones">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu1">
                                    <li class="opcion_menu"><a href="{{ route('maquinarias.edit', $value->id) }}">Editar <i class="fa fa-edit"></i></a></li>
                                    <li class="opcion_menu"><a href="{{ route('maquinarias.destroy', $value->id) }}" data-info="{{ $value->codigo }} - {{ $value->clase }}" data-id="{{ $value->id }}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar">Eliminar <i class="fa fa-trash"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="foto_cliente">
                            <a href="{{ route('maquinarias.show', $value->id) }}" class="foto">
                                <img src="{{ asset('imgs/equipos/' . $value->foto) }}" alt="Foto">
                            </a>
                        </div>
                        <div class="nombre_cliente text-white">{{ $value->codigo }}</div>
                        <div class="nombre_cliente text-white">{{ $value->clase }}</div>
                        <div class="nombre_cliente text-white">{{ $value->tipo }}</div>
                        <div class="nombre_cliente text-white">{{ $value->placa }}</div>
                        <div class="ocupacion_cliente text-left">Encargado: <span class="font-weight-bold text-white">{{ $value->user->datosUsuario->nombre}} {{ $value->user->datosUsuario->paterno}} {{ $value->user->datosUsuario->materno}}</span></div>
                        <div class="ocupacion_cliente text-left">Marca: <span class="font-weight-bold text-white">{{ $value->marca}}</span></div>
                        <div class="ocupacion_cliente text-left">Modelo: <span class="font-weight-bold text-white">{{ $value->modelo}}</span></div>
                        <div class="ocupacion_cliente text-left">Serie: <span class="font-weight-bold text-white">{{ $value->serie}}</span></div>
                        <div class="ocupacion_cliente text-left">Propiedad: <span class="font-weight-bold text-white">{{ $value->propiedad}}</span></div>
                        <div class="ir_evaluacion" style="width:100%!important;">
                            <a href="{{ route('maquinarias.show', $value->id) }}"
                                class="ir-evaluacion btn text-white" style="width:100%!important;">Ver mas...</a>
                        </div>
                        {{-- <div class="ir_evaluacion" style="width:100%!important;">
                            <a href="{{ route('maquinarias.pdf', $value->id) }}" target="_blank" class="ir-evaluacion btn btn-primary" style="width:100%!important;">PDF</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        NO SE ENCONTRARON REGISTROS
    </div>
@endif
