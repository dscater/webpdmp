<div class="modal fade" id="m_costos">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Resumen de Costos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.costos', 'method' => 'get', 'target' => '_blank', 'id' => 'formCostos']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select class="form-control" name="filtro" id="filtro">
                                <option value="todos">Todos</option>
                                <option value="tipo">Tipo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mes:</label>
                            {{ Form::select('mes', $array_meses, null, ['class' => 'form-control', 'required','id'=>'mes']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Año:</label>
                            {{ Form::select('anio', $array_anios, null, ['class' => 'form-control', 'required','id'=>'anio']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione el tipo:</label>
                            {{ Form::select('tipo', ['todos' => 'Todos', 'RETROEXCAVADORAS' => 'RETROEXCAVADORAS', 'PALAS' => 'PALAS', 'MARTILLO' => 'MARTILLO', 'EXCAVADORA' => 'EXCAVADORA', 'VIBRO COMPACTADORA' => 'VIBRO COMPACTADORA', 'TOPADORA' => 'TOPADORA', 'MOTONIVELADORA' => 'MOTONIVELADORA', 'CAMION' => 'CAMION', 'COMPRESORAS' => 'COMPRESORAS', 'GENERADOR ELÉCTRICO' => 'GENERADOR ELÉCTRICO', 'CAMIONETAS' => 'CAMIONETAS', 'MINIBUSES' => 'MINIBUSES', 'VOLQUETAS' => 'VOLQUETAS', 'SIN DOCUMENTOS' => 'SIN DOCUMENTOS', 'VARIOS' => 'VARIOS'], null, ['class' => 'form-control', 'required','id'=>'tipo']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Propiedad:</label>
                            <select class="form-control" name="propiedad" id="propiedad">
                                <option value="PROPIO">PROPIO</option>
                                <option value="ALQUILER">ALQUILER</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btnUsuarios">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
