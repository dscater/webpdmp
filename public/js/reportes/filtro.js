$(document).ready(function() {
    usuarios();
    maquinarias();
    costos();
});

function usuarios() {
    var tipo = $('#m_usuarios #tipo').parents('.form-group');
    var fecha_ini = $('#m_usuarios #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_usuarios #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    tipo.hide();
    $('#m_usuarios select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                tipo.hide();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'tipo':
                tipo.show();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                tipo.hide();
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function maquinarias() {
    var tipo = $('#m_maquinarias #tipo').parents('.form-group');
    tipo.hide();
    $('#m_maquinarias select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                tipo.hide();
                break;
            case 'tipo':
                tipo.show();
                break;
        }
    });
}

function costos() {
    var tipo = $('#m_costos #tipo').parents('.form-group');
    tipo.hide();
    $('#m_costos select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                tipo.hide();
                break;
            case 'tipo':
                tipo.show();
                break;
        }
    });
}