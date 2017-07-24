$('#agregarCategoria').on('hidden.bs.modal', function (e) {
      $(".addCategoryForm").validate().resetForm();
      $(this).find('input').val('');
      $(this).find('.form-control-warning').removeClass('form-control-warning');
})

var editando = false;
var last = null;

$("#agregarbtn").on('click', function () {
    if (editando){
        $(this).addClass("disabled");
        $(this).attr("data-toggle", "");
        return
    }
});

$('.edit').on('click', function (e) {
    if (error){
        return
    }
    if (editando == true){
    last.find('input').prop('readonly', true);
    last.find('form').validate().resetForm();
    last.find('form').trigger("reset");
    $('.editable').hide();
    $('.botones').show();   
    }
      $(this).closest("tr").find('input').prop('readonly', false);
      $(this).closest("div").hide();
      $(this).closest("tr").find('.editable').show();
      editando = true;
      last = $(this).closest("tr");
})

$('.editCancel').on('click', function (e) {
    error = false;
    $(this).closest("tr").find('input').prop('readonly', true);
    $(this).closest("tr").find('form').validate().resetForm();
    $(this).closest("tr").find('.editable').hide();
    $(this).closest("tr").find('.botones').show();
    editando = false;
    $("#agregarbtn").removeClass("disabled");
    $("#agregarbtn").attr("data-toggle", "modal");
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
        "dom": 'fltip',
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
    });
});

$(document).ready(function () {
    $("#mySubmissions").addClass("active");
    $(".editable").hide();
    $(".col-sm-12.col-md-6").first().remove();
});

    $('#usuarios').on( 'order.dt', function () {
    if (editando == true){
    last.find('input').prop('readonly', true);
    last.find('form').validate().resetForm();
    last.find('form').trigger("reset");
    $('.editable').hide();
    $('.botones').show();   
    editando = false;
    }
} );