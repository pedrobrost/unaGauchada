$(document).ready(function () {
    $("#mySubmissions").addClass("active");
    $(".editable").hide();
});


$('#agregarCategoria').on('hidden.bs.modal', function (e) {
      $(".addCategoryForm").validate().resetForm();
})

$('.edit').on('click', function (e) {
      $(this).closest("tr").find('input').prop('readonly', false);
      $(this).closest("div").hide();
      $(this).closest("tr").find('.editable').show();
})

$('.editCancel').on('click', function (e) {
    $(this).closest("tr").find('input').prop('readonly', true);
    $(this).closest("tr").find('form').validate().resetForm();
    $(this).closest("tr").find('.editable').hide();
    $(this).closest("tr").find('.botones').show();
})

$(document).ready(function () {
    $('#usuarios').DataTable({
        "order": [
            [0, "asc"]
        ],
           "aoColumnDefs": [
      { "bSortable": false, "aTargets": [ 2 ] }
    ],
      "columns": [
    { "width": "54%" },
    { "width": "16%" },
    { "width": "10%" }
  ],
  "bLengthChange": false,
          "info":     false,
          "bFilter": false,
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ usuarios",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando usuarios del _START_ al _END_",
        "sInfoEmpty":     "Mostrando usuarios del 0 al 0",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ usuarios)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
    });
});