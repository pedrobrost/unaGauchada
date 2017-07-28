$(document).ready( function() {
    $( "#profit_report" ).addClass( "active" );
});


$('#datePicker').daterangepicker({
    "ranges": {
        'Hoy': [moment(), moment()],
        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes': [moment().startOf('month'), moment().endOf('month')],
        'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Elegir fechas",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    "autoUpdateInput": false,
    "applyClass": "btn-primary",
    "showCustomRangeLabel": false,
    "alwaysShowCalendars": true,
    "linkedCalendars": false,
    "endDate": moment(),
    "opens": "left"
}, 
function(chosen_date, end) {
  $('#datePicker').val(chosen_date.format('DD/MM/YYYY') + " - " + end.format('DD/MM/YYYY') );
},
function (start, end, label) {
});