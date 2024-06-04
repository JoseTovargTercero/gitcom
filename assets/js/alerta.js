function alerta(texto, tipo) {
    if (tipo == 'ok') {
        var valor1 = '<i class="fa fa-check"></i>';
        var backColor = '#ed5264';
    } else {
        var valor1 = '<i class="fa fa-close"></i>';
        var backColor = '#58b6ff';
    }

    var notificacionBox = document.getElementById('notificacionBox');
    notificacionBox.style.background = backColor;

    $('#iconoNotificacion').html(valor1)
    $('#textoNotificacion').html(texto)
    $('#notificacionBox').show()

    setTimeout(function() {
        ocultarNotificacion()
    }, 5000);
}

function ocultarNotificacion() {
    $('#notificacionBox').addClass('fadeOutRight')
    setTimeout(function() {
        $('#notificacionBox').hide()
        $('#notificacionBox').removeClass('fadeOutRight')
    }, 1200);
}
