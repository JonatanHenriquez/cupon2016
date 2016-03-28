function notificacion(titulo, contenido, tipo) {
    Lobibox.notify(
        'sucess',  // Available types 'warning', 'info', 'success', 'error'
        {
            soundPath: 'web/lolibox/sounds/',
            sound: true,
            msg: contenido,
            delayIndicator: false,
            img: 'web/images/done.svg',


        }
    );
}

function enviarFormulario(idForm, _url) {
    //var fd = new FormData(document.getElementById(idForm));
    var fd = $(idForm).serialize();
    $.ajax({
        type: "POST",
        url: _url,
        data: fd,
        dataType: "json"
    }).done(function (respuesta) {
        notificacion(respuesta.mensaje.titulo, respuesta.mensaje.contenido, respuesta.mensaje.tipo);

    }).fail(function (jqXHR) {
        console.log(jqXHR.responseText);
    });
}


function messageBox(titulo, mensaje, color, tipo) {

}

function ajax(_url, _data, _dataType, _callback_done, _callback_fail) {
    $.ajax({
            type: "POST",
            url: _url,
            data: _data,
            dataType: _dataType
        })
        .done(_callback_done)
        .fail(_callback_fail);
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}