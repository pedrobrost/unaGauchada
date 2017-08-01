function trim(str) {
str = str.replace(/^\s+/, '');
for (var i = str.length - 1; i >= 0; i--) {
if (/\S/.test(str.charAt(i))) {
str = str.substring(0, i + 1);
break;
}
}
return str;
}

function dateHeight(dateStr){
if (trim(dateStr) != '') {
var frDate = trim(dateStr).split(' ');
var frDateParts = frDate[0].split('/');
var day = frDateParts[0] * 60 * 24;
var month = frDateParts[1] * 60 * 24 * 31;
var year = frDateParts[2] * 60 * 24 * 366;
var x = day+month+year;
} else {
var x = 99999999999999999; //GoHorse!
}
return x;
}

jQuery.fn.dataTableExt.oSort['date-euro-asc'] = function(a, b) {
var x = dateHeight(a);
var y = dateHeight(b);
var z = ((x < y) ? -1 : ((x > y) ? 1 : 0));
return z;
};

jQuery.fn.dataTableExt.oSort['date-euro-desc'] = function(a, b) {
var x = dateHeight(a);
var y = dateHeight(b);
var z = ((x < y) ? 1 : ((x > y) ? -1 : 0));
return z;
};

$(document).ready(function () {
    $('#ganancias').DataTable({
"aoColumns": [
null,
{ "sType": "date-euro"},
null,
null
],
        "order": [
            [1, "desc"]
        ],
        "bLengthChange": false,
        "info": false,
        "bFilter": false,
        "iDisplayLength": 10,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ usuarios",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando usuarios del _START_ al _END_",
            "sInfoEmpty": "Mostrando usuarios del 0 al 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ usuarios)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});