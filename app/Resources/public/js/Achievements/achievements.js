var editando = false;
var last = null;
var error = false;
var index;
var equal = false;

var icon = '<i class="noneEditable fa" aria-hidden="true"></i>';

$(document).ready(function () {
  $("#save").on('click', function () {
    if (error || editando) return false;
  });
  $('body').popover({
    html: true,
    trigger: 'manual',
    selector: '[data-toggle="popover"]',
    content: function () {
      return $(this).parent().find('.content').html();
    }
  });
  $('[data-toggle="popover"]').on("keypress", function () {
    $(this).popover('hide');
  });
  $("#mySubmissions").addClass("active");
  $(".editable").hide();
  $("input").prop("readonly", true);
  $TABLE.find("tr.hide").hide();
  $(".btns").hide();
  $up = $("tr:nth-child(3)").find(".table-up").clone(true);
  $down = $("tr:nth-last-child(2)").find(".table-down").clone(true);
  $("tr:nth-child(3)").find(".table-up").remove();
  $("tr:nth-last-child(2)").find(".table-down").remove();
  $(".icono").hide();
  $(".btn-icon").hide();
  $(".btn-icon").on("click", function () {
    $(this).closest("td").find("input").trigger("focusin");
  });
  $(".icono").each(function () {
    $(this).closest("td").append(icon);
    $(this)
      .closest("td")
      .find(".noneEditable")
      .addClass($(this).closest("td").find(".icono").val());
  });
});


$(".submit").on("click", function (e) {
  $new = false;
  $mov = false;
  $('[data-toggle="popover"]').popover('hide');
  var $nombre = $(this).closest("tr").find(".campoNombre");
  var $rango = $(this).closest("tr").find(".campoRango");
  var $before = $(this).closest("tr").prev();
  var $after = $(this).closest("tr").next();
  if ($nombre.val() == 0 || $rango.val() == 0) {
    error = true;
    if ($nombre.val() == 0) {
      $nombre.closest(".form-group").addClass("has-warning");
      $nombre.addClass("form-control-warning");
    } else {
      $nombre.closest(".form-group").removeClass("has-warning");
      $nombre.removeClass("form-control-warning");
      $nombre.closest(".form-group").addClass("has-success");
    }
    if ($rango.val() == 0) {
      $rango.closest(".form-group").addClass("has-warning");
      $rango.addClass("form-control-warning");
    } else {
      $rango.closest(".form-group").removeClass("has-warning");
      $rango.removeClass("form-control-warning");
      $rango.closest(".form-group").addClass("has-success");
    }
    return false;
  } else {
    $nombre.closest(".form-group").removeClass("has-warning");
    $nombre.removeClass("form-control-warning");
    $nombre.closest(".form-group").addClass("has-success");
    if (!$before.hasClass("hide") && !$after.hasClass("nonemove")) {
      if (
        parseInt($rango.val()) <= parseInt($before.find(".campoRango").val()) ||
        parseInt($rango.val()) >= parseInt($after.find(".campoRango").val())
      ) {
        $rango.closest(".form-group").addClass("has-danger");
        $rango.addClass("form-control-danger");
        error = true;
        equalName($nombre);
        $rango.closest('td').popover('show');
        return;
      }
    } else {
      if (!$before.hasClass("hide")) {
        if (
          parseInt($rango.val()) <= parseInt($before.find(".campoRango").val())
        ) {
          $rango.closest(".form-group").addClass("has-danger");
          $rango.addClass("form-control-danger");
          error = true;
          equalName($nombre);
          $rango.closest('td').popover('show');
          return;
        }
      } else {
        if (!$after.hasClass("nonemove")) {
          if (
            parseInt($rango.val()) >= parseInt($after.find(".campoRango").val())
          ) {
            $rango.closest(".form-group").addClass("has-danger");
            $rango.addClass("form-control-danger");
            error = true;
            equalName($nombre);
            $rango.closest('td').popover('show');
            return;
          }
        }
      }
    }
  }
  $rango.closest(".form-group").removeClass("has-warning");
  $rango.removeClass("form-control-warning");
  $rango.closest(".form-group").removeClass("has-danger");
  $rango.removeClass("form-control-danger");
  $rango.closest(".form-group").addClass("has-success");
  if (equalName($nombre)) {
    error = true;
    return;
  }
  error = false;
  $nombre.closest(".form-group").removeClass("has-danger");
  $nombre.removeClass("form-control-danger");
  $nombre.closest(".form-group").addClass("has-success");
  $(this).closest("tr").find("input").prop("readonly", true);
  $(this).closest("tr").find(".editable").hide();
  $(this).closest("tr").find(".botones").show();
  editando = false;
  if (btnAgregar == true) {
    $(".table-add").show();
    btnAgregar = false;
  }
  $nombre.attr("value", $nombre.val());
  $rango.attr("value", parseInt($rango.val()));
  $(this)
    .closest("tr")
    .find("td")
    .find(".icono")
    .attr("value", $(this).closest("tr").find("td").find(".icono").val());
  $(this).closest("tr").find("td:nth-child(3)").append(icon);
  $(this).closest("tr").find("td:nth-child(3)").find(".btn-icon").hide();
  $(this)
    .closest("tr")
    .find("td:nth-child(3)")
    .find(".btn-icon")
    .find("i")
    .remove();
  $(this)
    .closest("tr")
    .find("td:nth-child(3)")
    .find(".noneEditable")
    .addClass(
      $(this).closest("tr").find("td:nth-child(3)").find(".icono").val()
    );
  return true;
});

$(".edit").on("click", function (e) {
  index = $(this).closest("tr").index();
  if (error) {
    return;
  } else {
    if ($new && last) {
      var $nombre = last.closest("tr").find(".campoNombre");
      var $rango = last.closest("tr").find(".campoRango");
      if ($nombre.val() == 0 && $rango.val() == 0) {
        $(".table-add").show();
        btnAgregar = false;
        last.remove();
        cambio();
      }
      if ($nombre.val() == 0 || $rango.val() == 0) {
        error = true;
        if ($nombre.val() == 0) {
          $nombre.closest(".form-group").addClass("has-warning");
          $nombre.addClass("form-control-warning");
        } else {
          $nombre.closest(".form-group").removeClass("has-warning");
          $nombre.removeClass("form-control-warning");
          $nombre.closest(".form-group").addClass("has-success");
        }
        if ($rango.val() == 0) {
          $rango.closest(".form-group").addClass("has-warning");
          $rango.addClass("form-control-warning");
        } else {
          $rango.closest(".form-group").removeClass("has-warning");
          $rango.removeClass("form-control-warning");
          $rango.closest(".form-group").addClass("has-success");
        }
      }
    }
  }
  if ($(".btns:hidden")) {
    $(".btns").show();
  }
  if (editando == true) {
    last.find("input").prop("readonly", true);
    last.find("form").trigger("reset");
    $(".editable").hide();
    $(".botones").show();
    last.find("td:nth-child(3)").append(icon);
    last.find("td:nth-child(3)").find(".icono").hide();
    last
      .find("td:nth-child(3)")
      .find(".noneEditable")
      .addClass(last.find("td:nth-child(3)").find(".icono").val());
    last.find("td:nth-child(3)").find(".btn-icon").hide();
    last.find("td:nth-child(3)").find(".btn-icon").find("i").remove();
  }

  $(this).closest("tr").find("input").prop("readonly", false);
  $("#infinity").prop("readonly", true);
  $(this).closest("div").hide();
  $(this).closest("tr").find(".editable").show();
  $(this).closest("tr").find(".btn-icon").append(icon);
  $(this)
    .closest("tr")
    .find(".btn-icon")
    .find("i")
    .addClass($(this).closest("td").find(".icono").val());
  $(this).closest("tr").find("td > .noneEditable").remove();
  $(this).closest("tr").find("td").find(".btn-icon").show();
  $(this)
    .closest("tr")
    .find("td")
    .find(".btn-icon")
    .find("i")
    .addClass($(this).closest("tr").find("td").find(".icono").val());
  $(this)
    .closest("tr")
    .find("td")
    .find(".icono")
    .iconpicker($(this).closest("tr").find("td").find(".icono"));
  editando = true;
  last = $(this).closest("tr");
});

$(".editCancel").on("click", function (e) {
  var $nombre = $(this).closest("tr").find(".campoNombre");
  var $rango = $(this).closest("tr").find(".campoRango");
  $nombre.closest(".form-group").removeClass("has-warning");
  $nombre.removeClass("form-control-warning");
  $nombre.closest(".form-group").removeClass("has-danger");
  $nombre.removeClass("form-control-danger");
  $nombre.closest(".form-group").addClass("has-success");
  $rango.closest(".form-group").removeClass("has-warning");
  $rango.removeClass("form-control-warning");
  $rango.closest(".form-group").removeClass("has-danger");
  $rango.removeClass("form-control-danger");
  $rango.closest(".form-group").addClass("has-success");
  $(this).closest("tr").find("input").prop("readonly", true);
  $(this).closest("tr").find(".editable").hide();
  $(this).closest("tr").find(".botones").show();
  $(this).closest("tr").find("td:nth-child(3)").append(icon);
  $(this).closest("tr").find("td").find(".btn-icon").hide();
  $(this)
    .closest("tr")
    .find("td")
    .find(".icono")
    .val($(this).closest("tr").find("td").find(".icono").attr("value"));
  $(this)
    .closest("tr")
    .find("td:nth-child(3)")
    .find(".noneEditable")
    .addClass(
      $(this).closest("tr").find("td:nth-child(3)").find(".icono").val()
    );
  $(this)
    .closest("tr")
    .find("td:nth-child(3)")
    .find(".btn-icon")
    .find("i")
    .remove();
  editando = false;
  error = false;
  $new = false;
  $('[data-toggle="popover"]').popover('hide');
  if (btnAgregar == true) {
    $(".table-add").show();
    btnAgregar = false;
    $clone.remove();
    cambio();
  } else {
    var actual = $(this).closest("tr").index();
    if (index != actual) {
      if (index > actual) {
        for (i = 0; i < index - actual; i++) {
          $(this)
            .closest("tr")
            .find(".editable")
            .find(".table-down")
            .trigger("click");
        }
      } else {
        for (i = 0; i < actual - index; i++) {
          $(this)
            .closest("tr")
            .find(".editable")
            .find(".table-up")
            .trigger("click");
        }
      }
    }
  }
});

var $TABLE = $("#logros");
var btnAgregar = false;
var $clone;
var $up;
var $down;
var $new;
var $mov = false;

var cambio = function () {
  $(".editable").each(function () {
    $(this).find(".table-up").remove();
    $(this).find(".table-down").remove();
    if (!$(this).children().first().hasClass(".table-up")) {
      $(this).prepend($up.clone(true));
    }
    if ($(this).find(".table-down").length <= 0) {
      $down.clone(true).insertAfter($(this).find(".table-up"));
    }
  });
  $("tr:nth-child(3)").find(".table-up").remove();
  $("tr:nth-last-child(2)").find(".table-down").remove();
  $("tr:nth-last-child(1)").find(".table-down").remove();
  $("tr:nth-last-child(1)").find(".table-up").remove();
};

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
  if ($(".btns:hidden")) {
    $(".btns").show();
  }
  $new = true;
  $clone = $TABLE.find("tr.hide").clone(true).removeClass("hide table-line");
  $clone.show();
  $clone.find("input").prop("readonly", false);
  $clone.find(".edit").trigger("click");
  last = $clone;
  $clone.find(".table-up").remove();
  $clone.insertAfter($TABLE.find("tr.hide"));
  $(".table-add").hide();
  btnAgregar = true;
  editando = true;
  cambio();
  $clone.find(".table-up").remove();
  $('body').popover({
    html: true,
    trigger: 'manual',
    selector: '[data-toggle="popover"]',
    content: function () {
      return $(this).parent().find('.content').html();
    }
  });
  $('[data-toggle="popover"]').on("keypress", function () {
    $(this).popover('hide');
  });
});

$(".table-remove").click(function () {
  if (!editando) {
    $(this).parents("tr").remove();
    cambio();
  }
});

$(".table-up").click(function () {
  $mov = true;
  $('[data-toggle="popover"]').popover('hide');
  var $row = $(this).parents("tr");
  if ($row.index() === 1) return; // Don't go above the header
  $row.prev().before($row.get(0));
  cambio();
});

$(".table-down").click(function () {
  $mov = true;
  $('[data-toggle="popover"]').popover('hide');
  var $row = $(this).parents("tr");
  if ($row.next().hasClass("nonemove")) return;
  $row.next().after($row.get(0));
  cambio();
});

$(".deshacer").click(function () {
  location.reload(true);
});