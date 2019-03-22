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
    } // if(validDate())
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
                // console.log(data);
                var fi = $('#fi').val();
                var ft = $('#ft').val();
                var supervisor_select = $('#supervisor option:selected').text();
                var inputs = '<input type="text" name="fi" value="' + fi + '">' +
                    '<input type="text" name="ft" value="' + ft + '">' +
                    '<input type="text" name="supervisor_select" value="' + supervisor_select + '">';
                for(var i = 0; i < data.length; i++) {
                    inputs = inputs +
                    '<input type="text" name="anio[]" value="' + data[i].anio + '">' +
                    '<input type="text" name="semana[]" value="' + data[i].semana + '">' +
                    '<input type="text" name="fecha[]" value="' + data[i].fecha + '">' +
                    '<input type="text" name="platica[]" value="' + data[i].platica + '">' +
                    '<input type="text" name="clave_supervisor[]" value="' + data[i].clave_supervisor + '">' +
                    '<input type="text" name="supervisor[]" value="' + data[i].supervisor + '">' +
                    '<input type="text" name="empresa[]" value="' + data[i].empresa + '">' +
                    '<input type="text" name="codigo[]" value="' + data[i].codigo + '">' +
                    '<input type="text" name="empleado[]" value="' + data[i].empleado + '">' +
                    '<input type="text" name="puesto[]" value="' + data[i].puesto + '">';
                }

                if(document.getElementById('formDownload'))
                    $('#formDownload').remove();
                // Build form (hide keeps it from being visible)
                $form = $('<form/>').attr({id: 'formDownload', method: 'POST', action: 'assets/reporte_excel/descargar.php'}).hide();
                // Add inputs to form
                $form.append(inputs);
                // Add form to the document body
                $('body').append($form);
                // Submit the form and PHPExcel should open a dialog to download the file
                $form.submit();
                $('body').css('cursor', 'auto');
            },
            error: function() {
                console.log("¡Error al descargar! No se pudo descargar el archivo XLSX");
                $('body').css('cursor', 'auto');
            }
        });
    } // if(validDate())
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