<div class="modal fade" id="modal_confirma_entrega">
    <div class="modal-dialog">
      <div class="modal-content bg-yellow">
        <div class="modal-header">
            <h4 class="modal-title" id="txtTituloEliminar">Confirmar Entrega</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="formConfirmaEntrega">
                {{ method_field('post') }}
                @csrf
            </form>
            <p id="mensajeConfirmaEntrega"></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">No, cancelar</button>
          <button type="button" class="btn btn-primary" id="btnEntregar">Si, estoy seguro(a)</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
   <!-- /.modal -->