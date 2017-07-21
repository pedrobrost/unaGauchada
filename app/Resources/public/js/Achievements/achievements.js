var editando = false;
var last = null;
var error = false;

$(".submit").on("click", function (e) {
  var $nombre = $(this).closest("tr").find('.campoNombre');
  var $rango = $(this).closest("tr").find('.campoRango');
  if (($nombre.val() == 0) || ($rango.val() == 0)) {
    error = true;
    if ($nombre.val() == 0) {
      $nombre.closest('.form-group').addClass('has-warning');
      $nombre.addClass('form-control-warning');
    } else {
      $nombre.closest('.form-group').removeClass('has-warning');
      $nombre.removeClass('form-control-warning');
      $nombre.closest('.form-group').addClass('has-success');
    }
    if ($rango.val() == 0) {
      $rango.closest('.form-group').addClass('has-warning');
      $rango.addClass('form-control-warning');
    } else {
      $rango.closest('.form-group').removeClass('has-warning');
      $rango.removeClass('form-control-warning');
      $rango.closest('.form-group').addClass('has-success');
    }
    return;
  }
  error = false;
  $nombre.closest('.form-group').removeClass('has-warning');
  $nombre.removeClass('form-control-warning');
  $nombre.closest('.form-group').addClass('has-success');
  $rango.closest('.form-group').removeClass('has-warning');
  $rango.removeClass('form-control-warning');
  $rango.closest('.form-group').addClass('has-success');
  $(this).closest("tr").find("input").prop("readonly", true);
  $(this).closest("tr").find(".editable").hide();
  $(this).closest("tr").find(".botones").show();
  editando = false;
  if ((btnAgregar = true)) {
    $(".table-add").show();
    btnAgregar = false;
  }
});

$(".edit").on("click", function (e) {
  if ($('.btns:hidden')) {
    $('.btns').show()
  };
  if (editando == true) {
    last.find("input").prop("readonly", true);
    last.find("form").trigger("reset");
    $(".editable").hide();
    $(".botones").show();
  }
  $(this).closest("tr").find("input").prop("readonly", false);
  $("#infinity").prop("readonly", true);

  $(this).closest("div").hide();
  $(this).closest("tr").find(".editable").show();
  editando = true;
  last = $(this).closest("tr");
});

$(".editCancel").on("click", function (e) {
    var $nombre = $(this).closest("tr").find('.campoNombre');
  var $rango = $(this).closest("tr").find('.campoRango');
    $nombre.closest('.form-group').removeClass('has-warning');
  $nombre.removeClass('form-control-warning');
  $nombre.closest('.form-group').addClass('has-success');
  $rango.closest('.form-group').removeClass('has-warning');
  $rango.removeClass('form-control-warning');
  $rango.closest('.form-group').addClass('has-success');
  $(this).closest("tr").find("input").prop("readonly", true);
  $(this).closest("tr").find(".editable").hide();
  $(this).closest("tr").find(".botones").show();
  editando = false;
  error = false;
  if ((btnAgregar = true)) {
    $(".table-add").show();
    btnAgregar = false;
    $clone.remove();
  }
});
var $desahacer = $("#logros").clone();
var $TABLE = $("#logros");
var btnAgregar = false;
var $clone;
var $up;
var $down;


$(document).ready(function () {
  $("#mySubmissions").addClass("active");
  $(".editable").hide();
  $("input").prop("readonly", true);
  $TABLE.find("tr.hide").hide();
  $('.btns').hide();
  $up = $("tr:nth-child(3)").find('.table-up').clone(true);
  $down = $("tr:nth-last-child(2)").find('.table-down').clone(true);
  $("tr:nth-child(3)").find('.table-up').remove();
  $("tr:nth-last-child(2)").find('.table-down').remove();

});

var cambio = function () {
  $(".editable").each(function () {
    $(this).find('.table-up').remove();
    $(this).find('.table-down').remove();
    if (!$(this).children().first().hasClass(".table-up")) {
      $(this).prepend($up.clone(true));
    }
    if ($(this).find(".table-down").length <= 0) {
      $down.clone(true).insertAfter($(this).find('.table-up'));
    }
  });
  $("tr:nth-child(3)").find('.table-up').remove();
  $("tr:nth-last-child(2)").find('.table-down').remove();
  $("tr:nth-last-child(1)").find('.table-down').remove();
  $("tr:nth-last-child(1)").find('.table-up').remove();
}

$("td").on("keydown paste", function (event) {
  //Prevent on paste as well
  if ($(this).text().length === 10 && event.keyCode != 8) {
    event.preventDefault();
  }
});

$("#range").keypress(function (e) {
  if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
});

$(".table-add").click(function () {
  if (error) return;
  error = true;
  if ($('.btns:hidden')) {
    $('.btns').show()
  };
  $clone = $TABLE.find("tr.hide").clone(true).removeClass("hide table-line");
  $clone.show();
  $clone.find("input").prop("readonly", false);
  $clone.find(".edit").trigger("click");
  last = $clone;
  $clone.find('.table-up').remove();
  $clone.insertBefore($TABLE.find("tr.hide"));
  $(".table-add").hide();
  btnAgregar = true;
  editando = true;
  cambio();
  $clone.find('.table-up').remove();
});

$(".table-remove").click(function () {
  $(this).parents("tr").remove();
  cambio();
});

$(".table-up").click(function () {
  var $row = $(this).parents("tr");
  if ($row.index() === 1) return; // Don't go above the header
  $row.prev().before($row.get(0));
  cambio();
});

$(".table-down").click(function () {
  var $row = $(this).parents("tr");
  if ($row.next().hasClass("nonemove")) return;
  $row.next().after($row.get(0));
  cambio();
});

$(".deshacer").click(function () {
  location.reload(true);
});