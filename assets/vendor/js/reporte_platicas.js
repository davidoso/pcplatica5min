$('#btn_buscar').click(function() {
    if(validDate()) {
	    $('body').css('cursor', 'wait');
        var data = $('#report_form').serialize();

        $.ajax({
            type: "post",
            dataType: "json",
		    url: "index.php/Supervisor/reporte_buscar",
            data: data,
            success: function(data) {
                // console.log(data);
                var html = "";
                var i = 0;
                var alertMessage = "";
                for(i; i < data.length; i++) {
                    html +='<tr>'+
                        '<td scope="col" class="text-center align-middle" width="5%">'+data[i].semana+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="10%">'+data[i].fecha+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="18%">'+data[i].platica+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="17%">'+data[i].supervisor+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="14%">'+data[i].empresa+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="5%">'+data[i].codigo+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="17%">'+data[i].empleado+'</td>'+
                        '<td scope="col" class="text-center align-middle" width="14%">'+data[i].puesto+'</td>'+
                        '</tr>';
                }
                $('#report_tbody').html(html);
                $('#report_tbl').css('display', 'table');
                $('#report_title').css('display', 'block');
                switch(i) {
                    case 0: alertMessage = "No se encontraron participantes";
                        break;
                    case 1: alertMessage = "Se encontró un participante";
                        break;
                    default: alertMessage = "Se encontraron " + i + " participantes";
                }
                printAlert('alert-success', 'fa-list-alt', alertMessage);
                $('body').css('cursor', 'auto');
            },
            error: function() {
                console.log("¡Error al buscar! No se pudo consultar la base de datos");
                $('body').css('cursor', 'auto');
            }
        });
    }
}); // btn_buscar click

$('#btn_descargar').click(function() {
    if(validDate()) {
	    $('body').css('cursor', 'wait');
        var data = $('#report_form').serialize();

        $.ajax({
            type: "post",
            dataType: "json",
		    url: "index.php/Supervisor/reporte_buscar",
            data: data,
            success: function(data) {
                $('body').css('cursor', 'auto');
            },
            error: function() {
                console.log("¡Error al descargar! No se pudo descargar el archivo XLSX");
                $('body').css('cursor', 'auto');
            }
        });
    }
}); // btn_descargar click

function validDate() {
    var fi = $('#fi').val();
    var ft = $('#ft').val();
    var today = new Date().toISOString().slice(0, 10);

    if(fi < '2018-10-23' || ft < '2018-10-23') {
        printAlert('alert-warning', 'fa-exclamation-triangle', 'Las fechas de inicio y/o término deben ser a partir del 23 de octubre de 2018');
        return false;
    }
    if(fi > today || ft > today) {
        printAlert('alert-warning', 'fa-exclamation-triangle', 'Las fechas de inicio y/o término no deben ser mayores al día de hoy');
        return false;
    }
    if(ft < fi) {
        printAlert('alert-warning', 'fa-exclamation-triangle', 'La fecha de término debe ser mayor a la de inicio');
        return false;
    }

    return true;
}

function printAlert(alertClass, faClass, messageHTML) {
    var innerHTML = '<div style="display: static;" class="alert ' + alertClass +'" id="myAlert"><i class="fa ' + faClass + '" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp;&nbsp;' + messageHTML + '</div>';

    $("#myAlertDiv").html(innerHTML);
    $("#myAlert").fadeTo(3000, 200).slideUp(400, function() {
        $("#myAlert").slideUp(400);
    });
}