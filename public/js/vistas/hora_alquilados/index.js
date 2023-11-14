let btnNuevoRegistroDiario = $('#btnNuevoRegistroDiario');
let modal_control = $('#modal_control');
let contenedorFormulario = $('#contenedorFormulario')
let maquinaria_id = $('#maquinaria_id');
let mes = $('#mes');
let anio = $('#anio');
let contenedorRegistros = $('#contenedorRegistros');

let btnActualizaFormulario = $('#btnActualizaFormulario');
let btnEliminaFormulario = $('#btnEliminaFormulario');
let sw_modal = false;
$(document).ready(function() {
    getRegistros();
    maquinaria_id.change(getRegistros);
    mes.change(getRegistros);
    anio.change(getRegistros);
    btnNuevoRegistroDiario.hide();

    // MUESTRA FORM REGISTRO
    btnNuevoRegistroDiario.click(function() {
        getForm();
    });

    // GUARDA NUEVO REGISTRO
    contenedorFormulario.on('click', '#btnRegistraFormulario', function() {
        enviaInformación();
    });

    // MOSTRAR FORM MODIFICAR
    contenedorRegistros.on('click', '.tabla_registros tbody tr', function() {
        let id = $(this).attr('data-id');
        if (id != '') {
            getForm('modificar', id);
        } else {
            let dia_s = $(this).children('td').eq(1).text();
            getForm('nuevo', null, dia_s);
        }
    });

    // ACTUALIZAR
    contenedorFormulario.on('click', '#btnActualizaFormulario', function() {
        enviaInformación('modificar');
    });

    // ELIMINAR
    contenedorFormulario.on('click', '#btnEliminaFormulario', function() {
        sw_modal = true;
        modal_control.modal('hide');
        $('#modal-eliminar').modal('show');
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar este registro?<br/><b>El registro no se podrá recuperar después</b>`);
    });

    $('#btnEliminar').click(function() {
        sw_modal = false;
        enviaInformación('eliminar');
    });

    $('#modal-eliminar').on('hidden.bs.modal', function() {
        if (sw_modal) {
            modal_control.modal('show');
        }
    });

    // ENTREGA
    contenedorFormulario.on('click', '#btnEntregaRegistro', function() {
        sw_modal = true;
        modal_control.modal('hide');
        $('#modal_confirma_entrega').modal('show');
        $('#mensajeConfirmaEntrega').html(`¿Está seguro(a) de realizar la entrega de este registro?<br>El registro se actualizara con la información actual, y ya no podras realizar cambios sobre el.`);
    });
    $('#btnEntregar').click(function() {
        sw_modal = false;
        enviaInformación('entregar');
    });

    $('#modal_confirma_entrega').on('hidden.bs.modal', function() {
        if (sw_modal) {
            modal_control.modal('show');
        }
    });
});

function enviaInformación(accion = 'nuevo') {
    let url = contenedorFormulario.find('#formularioRegistroHora').attr('action');
    let metodo = 'post';
    let data = contenedorFormulario.find('#formularioRegistroHora').serialize();
    if (accion == 'eliminar') {
        metodo = 'delete';
        data = null;
        url = contenedorFormulario.find('#urlEliminarFormulario').val();
    }
    if (accion == 'modificar') {
        metodo = 'put';
    }

    if (accion == 'entregar') {
        metodo = 'put';
        data += '&sw_entrega=true';
    }
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('#token').val() },
        type: metodo,
        url: url,
        data: data,
        dataType: "json",
        success: function(response) {
            sw_modal = false;
            alerta(response.titulo, response.msj, response.resp);
            getRegistros();
            modal_control.modal('hide');
            $('#modal-eliminar').modal('hide');
            $('#modal_confirma_entrega').modal('hide');
        }
    });
}

function getRegistros() {
    contenedorRegistros.html('Cargando...');
    if (validaDatosRegistros())
        $.ajax({
            type: "GET",
            url: $('#urlGetRegistros').val(),
            data: {
                maquinaria_id: maquinaria_id.val(),
                mes: mes.val(),
                anio: anio.val(),
            },
            dataType: "json",
            success: function(response) {
                contenedorRegistros.html(response)
                if (response != 'NO TIENES NINGÚN EQUIPO/MAQUINARIA DE TIPO ALQUILADO ASIGNADO') {
                    btnNuevoRegistroDiario.show();
                }
            },
            error: function(e) {
                alerta('¡ATENCIÓN!', 'ERROR. Ocurrió un error en el sistema', 'error');
            }
        });
}


function validaDatosRegistros() {
    if (maquinaria_id.val() != '' && mes != '' && anio != '') {
        return true;
    }
    btnNuevoRegistroDiario.hide();
    contenedorRegistros.html('SELECCIONE UN EQUIPO/MAQUINARIA');
    return false;
}

function getForm(accion = 'nuevo', hora_alquilado_id = null, dia_seleccionado = null) {
    $.ajax({
        type: "GET",
        url: $('#urlGetFormulario').val(),
        data: {
            accion: accion,
            maquinaria_id: maquinaria_id.val(),
            hora_alquilado_id: hora_alquilado_id,
            mes: mes.val(),
            anio: anio.val(),
        },
        dataType: "json",
        success: function(response) {
            contenedorFormulario.html(response);
            modal_control.modal('show');
            if (dia_seleccionado != null) {
                console.log(dia_seleccionado);
                contenedorFormulario.find('.dia_select').val(dia_seleccionado);
            }
        }
    });
}