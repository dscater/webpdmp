let ultimo_id = 0;
let nroNotificaciones = $('#nroNotificaciones');
let contenedorNotificaciones = $('#contenedorNotificaciones');
let totalNotificaciones = $('#totalNotificaciones');
let sw = false;

$(document).ready(function() {
    totalNotificaciones.val('0');
    notificaciones();
    sw = false;
    setInterval(notificaciones, 2000);
});

function notificaciones() {
    $.ajax({
        type: "GET",
        url: $('#urlNotificaciones').val(),
        data: { ultimo_id: ultimo_id },
        dataType: "json",
        success: function(response) {
            if (response.sw) {
                totalNotificaciones.val(response.total);
                contenedorNotificaciones.children('#verNotificaciones').before(response.html);
                if (parseInt(response.sin_ver) > 0) {
                    mensajeNotificacion2('Tienes notificaciones para ver', 'info', 'bottom-end');
                    nroNotificaciones.text(response.sin_ver);
                }
                ultimo_id = response.ultimo_id;
            }
            comprueba();
        }
    });
}

function comprueba() {
    let notificacions = contenedorNotificaciones.children('.notificacion');
    if (notificacions.length == 0) {
        if (contenedorNotificaciones.find('.sin_notificaciones').length == 0) {
            contenedorNotificaciones.children('#verNotificaciones').before(`<a href="" class="dropdown-item sin_notificaciones">NO HAY NOTIFICACIONES          <div class="dropdown-divider"></div></a>`);
        }
    }
}