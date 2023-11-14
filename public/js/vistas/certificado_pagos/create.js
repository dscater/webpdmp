let eliminaExistentes1 = $('#eliminaExistentes1');
let eliminaExistentes2 = $('#eliminaExistentes2');

let fila1 = `<tr class="fila">
<td><span>#</span></td>
<td><input type="date" name="fechas1[]" class="form-control" required></td>
<td><input type="text" name="detalles1[]" value="" class="form-control" required></td>
<td><input type="text" name="unidades1[]" value="" class="form-control" required></td>
<td><input type="number" step="0.01" name="cantidades1[]" value="0" class="form-control" required></td>
<td><input type="number" step="0.01" name="pu1[]" value="0" class="form-control" required></td>
<td><span></span><input type="hidden" name="totales1[]" value="0" class="form-control" required></td>
<td class="btn-opciones"><span><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i> Quitar</span></td>
</tr>`;
let fila2 = `<tr class="fila">
<td><span>#</span></td>
<td><input type="date" name="fechas2[]" class="form-control" required></td>
<td><input type="text" name="detalles2[]" value="" class="form-control" required></td>
<td><input type="text" name="unidades2[]" value="" class="form-control" required></td>
<td><input type="number" step="0.01" name="cantidades2[]" value="0" class="form-control" required></td>
<td><input type="number" step="0.01" name="pu2[]" value="0" class="form-control" required></td>
<td><span></span><input type="hidden" name="totales2[]" value="0" class="form-control" required></td>
<td class="btn-opciones"><span><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i> Quitar</span></td>
</tr>`;

let vacio = `<tr class="vacio"><td colspan="8" class="text-center">NO SE AGREGARÓN FILAS</td></tr>`;
let btnGuardar = $('#btnGuardar');

let urlGetDatos = $('#urlGetDatos').val();
let urlGetLiteral = $('#urlGetLiteral').val();

let maquinaria_id = $('#maquinaria_id');
let mes = $('#mes');
let anio = $('#anio');

let btnAgregarFila1 = $('#btnAgregarFila1');
let btnAgregarFila2 = $('#btnAgregarFila2');

let contenedorFilas1 = $('#contenedorFilas1');
let contenedorFilas2 = $('#contenedorFilas2');

let total1 = $('#total1');
let total2 = $('#total2');
let liquido_pagable = $('#liquido_pagable');
let contenedorDatos = $('#contenedorDatos');
let elemento = null;
$(document).ready(function() {
    getDatos();
    maquinaria_id.change(getDatos);
    mes.change(getDatos);
    anio.change(getDatos);

    btnAgregarFila1.click(function() {
        let nueva_fila = $(fila1).clone();
        contenedorFilas1.append(nueva_fila);
        validaFilas(contenedorFilas1, total1);
    });
    btnAgregarFila2.click(function() {
        let nueva_fila = $(fila2).clone();
        contenedorFilas2.append(nueva_fila);
        validaFilas(contenedorFilas2, total2);
    });

    contenedorFilas1.on('keyup', 'input', function() {
        validaFilas(contenedorFilas1, total1);
    });
    contenedorFilas2.on('keyup', 'input', function() {
        validaFilas(contenedorFilas2, total2);
    });

    contenedorFilas1.on('click', 'td.btn-opciones span', function(e) {
        let fila = $(this).parents('tr');
        elemento = fila;
        e.preventDefault();
        $('#modal-eliminar').modal('show');
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro?`);
        if (fila.attr('data-elimina')) {
            let url = fila.attr('data-elimina');
            $('#formEliminar').prop('action', url);
        }
    });


    contenedorFilas2.on('click', 'td.btn-opciones span', function(e) {
        let fila = $(this).parents('tr');
        elemento = fila;
        e.preventDefault();
        $('#modal-eliminar').modal('show');
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro?`);
        if (fila.attr('data-elimina')) {
            let url = fila.attr('data-elimina');
            $('#formEliminar').prop('action', url);
        }
    });

    $('#btnEliminar').click(function() {
        if (elemento.hasClass('existe')) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('#token').val() },
                type: "DELETE",
                url: $('#formEliminar').attr('action'),
                dataType: "json",
                success: function(response) {
                    $('#modal-eliminar').modal('hide');
                    elemento.remove();
                    validaFilas(contenedorFilas1, total1);
                    validaFilas(contenedorFilas2, total2);
                }
            });
        } else {
            $('#modal-eliminar').modal('hide');
            elemento.remove();
            elemento = null;
            validaFilas(contenedorFilas1, total1);
            validaFilas(contenedorFilas2, total2);
        }
    });
});

function getDatos() {
    if (validaDatos()) {
        $.ajax({
            type: "GET",
            url: urlGetDatos,
            data: {
                maquinaria_id: maquinaria_id.val(),
                mes: mes.val(),
                anio: anio.val()
            },
            dataType: "json",
            success: function(response) {
                if (response.sw) {
                    contenedorDatos.html(response.datos);
                    contenedorFilas1.html(response.filas1);
                    contenedorFilas2.html(response.filas2);
                } else {
                    contenedorDatos.html(response.datos);
                    contenedorFilas1.html(vacio);
                    contenedorFilas2.html(vacio);
                    alerta('¡ERROR!', 'El Equipo/Maquinaria, no cuenta con un proyecto asignado, en el mes y año seleccionado.', 'error');
                }
                validaFilas(contenedorFilas1, total1);
                validaFilas(contenedorFilas2, total2);
            },
            error: function(e) {
                alerta('¡ATENCIÓN!', 'ERROR. Ocurrió un error en el sistema', 'error');
            }
        });
    } else {
        contenedorFilas1.html(vacio);
        contenedorFilas2.html(vacio);
        validaFilas(contenedorFilas1, total1);
        validaFilas(contenedorFilas2, total2);
    }
}

function validaDatos() {
    if (maquinaria_id.val() != '' && mes.val() != '' && anio.val() != '') {
        return true;
    }
    return false;
}

function validaFilas(contenedor, total) {
    btnGuardar.prop('disabled', true);
    total.children('tr').eq(0).children('th').eq(1).children('span').text('0.00');
    total.children('tr').eq(0).children('th').eq(1).children('input').val('0');
    let filas = contenedor.children('tr.fila');
    if (filas.length > 0) {
        contenedor.find('tr.vacio').remove();
        btnGuardar.removeAttr('disabled');
        let res_total = getTotales(filas);
        total.children('tr').eq(0).children('th').eq(1).children('span').text(parseFloat(res_total).toFixed(2));
        total.children('tr').eq(0).children('th').eq(1).children('input').val(parseFloat(res_total).toFixed(2));
    } else {
        contenedor.html(vacio);
    }
    setTimeout(getPagable, 500);
}

function getTotales(filas) {
    let suma_total = 0;
    let total = 0;
    let cont = 1;
    let cantidad = 0;
    let pu = 0;
    filas.each(function() {
        $(this).children('td').eq(0).children('span').text(cont++);
        cantidad = $(this).children('td').eq(4).children('input').val();
        pu = $(this).children('td').eq(5).children('input').val();
        total = parseFloat(cantidad) * parseFloat(pu);
        suma_total += total;
        $(this).children('td').eq(6).children('span').text(parseFloat(total).toFixed(2));
        $(this).children('td').eq(6).children('input').val(total);
    });

    return suma_total;
}

function getPagable() {
    let t1 = total1.children('tr').eq(0).children('th').eq(1).children('input').val();
    let t2 = total2.children('tr').eq(0).children('th').eq(1).children('input').val();
    console.log(parseFloat(t1), parseFloat(t2));
    let pagable = parseFloat(t1) - parseFloat(t2);
    $.ajax({
        type: "GET",
        url: urlGetLiteral,
        data: { valor: pagable },
        dataType: "json",
        success: function(response) {
            liquido_pagable.children('tr').eq(0).children('th').eq(1).children('span').text(parseFloat(pagable).toFixed(2));
            liquido_pagable.children('tr').eq(0).children('th').eq(1).children('input').val(pagable);
            liquido_pagable.children('tr').eq(1).children('th').text(response);
        }
    });
}