var $clone;
var $up;
var $down;
var $new;
var index;
var editando = false;
var btnAgregar = false;
var last = null;
var borrar = null;
var error = false;
var $TABLE = $("#logros");
var icon = '<i class="noneEditable fa" aria-hidden="true"></i>';

$(document).ready(function () {
    $( "#achievements_management" ).addClass( "active" );
    $("#save").on('click', function () {
        if (error || editando) {
            $(this).addClass("disabled");
            return false;
        }
    });
    $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      if (last){
          last.find("td").find(".submit").trigger("click");
      }
      return false;
    }
  });
    $up = $("tr:nth-child(3)").find(".table-up").clone(true);
    $down = $("tr:nth-last-child(2)").find(".table-down").clone(true);
    $(".editable").hide();
    $("input").prop("readonly", true);
    $TABLE.find("tr.hide").hide();
    $(".btns").hide();
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
    $('[data-toggle="popover"]').on("keypress", function () {
        $(this).popover('hide');
    });
});

$(".eliminar").click(function () {
    if (!editando) {
        borrar = $(this);
        $('.modalText').text($(this).closest("tr").find(".campoNombre").val());
        $('#deleteModal').modal("show");
    }
});

$(".table-remove").click(function () {
    borrar.parents("tr").remove();
    cambio();
    if ($(".btns:hidden")) {
        $(".btns").show();
    }
});

$(".table-up").click(function () {
    $(this).closest("tr").find("td").popover("hide");
    var $row = $(this).parents("tr");
    if ($row.index() === 1) return; // Don't go above the header
    $row.prev().before($row.get(0));
    cambio();
});

$(".table-down").click(function () {
    $(this).closest("tr").find("td").popover("hide");
    var $row = $(this).parents("tr");
    if ($row.next().hasClass("nonemove")) return;
    $row.next().after($row.get(0));
    cambio();
});

$(".deshacer").click(function () {
    location.reload(true);
});

$(".edit").on("click", function (e) {
    if ($(".btns:hidden")) {
        $(".btns").show();
    }
    $(this).closest("tr").find("input").prop("readonly", false);
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
    if (editando == true) {
        last.closest("tr").find("td").find(".editCancel").trigger("click");
    }
    editando = true;
    error = false;
    last = $(this).closest("tr");
    index = $(this).closest("tr").index();
});

$(".editCancel").on("click", function (e) {
    if ($new) {
        $new = false;
        btnAgregar = false;
        editando = false;
        error = false;
        last.find('td').popover("dispose");
        borrar = $(this);
        $("#save").removeClass("disabled");
        $(".table-add").removeClass("disabled");
        $(".table-add").show();
        $(".table-remove").trigger("click");
        return;
    }
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
    cambio();
    rePosicionar($(this).closest("tr"));
    editando = false;
    error = false;
    $("#save").removeClass("disabled");
    $(".table-add").removeClass("disabled");

    var $nombre = $(this).closest("tr").find(".campoNombre");
    var $rango = $(this).closest("tr").find(".campoRango");
    unhighlight($nombre, "warning");
    unhighlight($nombre, "danger");
    unhighlight($rango, "warning");
    unhighlight($rango, "danger");
});


$(".table-add").click(function () {
    if ($(".btns:hidden")) {
        $(".btns").show();
    }
    if (editando) {
        $(this).addClass("disabled");
        return
    }
    $new = true;
    $clone = $TABLE.find("tr.hide").clone(true).removeClass("hide table-line");
    $clone.show();
    $clone.find("input").prop("readonly", false);
    $clone.find(".edit").trigger("click");
    $clone.insertAfter($TABLE.find("tr.hide"));
    $(".table-add").hide();
    $clone.find(".table-up").remove();
    btnAgregar = true;
    editando = true;
    cambio();
});

$(".submit").on("click", function () {
    var $nombre = $(this).closest("tr").find(".campoNombre");
    var $rango = $(this).closest("tr").find(".campoRango");
    if (emptyValidation($nombre, $rango) | rangeValidation($rango) | equalName($nombre)) {
        error = true;
        return;
    }
    $new = false;
    editando = false;
    error = false;
    $("#save").removeClass("disabled");
    $(".table-add").removeClass("disabled");
    $(this).closest("tr").find("input").prop("readonly", true);
    $(this).closest("tr").find(".editable").hide();
    $(this).closest("tr").find(".botones").show();
    if (btnAgregar == true) {
        $(".table-add").show();
        btnAgregar = false;
    }
    nuevoIcono($(this).closest("tr"));
    cambio();
    $nombre.attr("value", $nombre.val());
    $rango.attr("value", parseInt($rango.val()));
    last = null;
});


var nuevoIcono = function (element) {
    $(element).find("td")
        .find(".icono")
        .attr("value", $(element).find("td").find(".icono").val());
    $(element).find("td:nth-child(3)").append(icon);
    $(element).find("td:nth-child(3)").find(".btn-icon").hide();
    $(element).find("td:nth-child(3)")
        .find(".btn-icon")
        .find("i")
        .remove();
    $(element)
        .find("td:nth-child(3)")
        .find(".noneEditable")
        .addClass(
            $(element).find("td:nth-child(3)").find(".icono").val()
        );
    return true;
}

var rePosicionar = function (element) {
    var actual = element.index();
    if (index != actual) {
        if (index > actual) {
            for (i = 0; i < index - actual; i++) {
                element
                    .find(".editable")
                    .find(".table-down")
                    .trigger("click");
            }
        } else {
            for (i = 0; i < actual - index; i++) {
                element
                    .find(".editable")
                    .find(".table-up")
                    .trigger("click");
            }
        }
    }
}

var changeForm = function () {
    var cantidad = 1
    $("tr").not(":first").not(".hide").not(".nonemove").each(function () {
        $(this).find(".campoNombre").attr("name", ("campoNombre" + cantidad));
        $(this).find(".campoNombre").attr("id", ("campoNombre" + cantidad));
        $(this).find(".campoRango").attr("name", ("campoRango" + cantidad));
        $(this).find(".campoRango").attr("id", ("campoRango" + cantidad));
        $(this).find(".campoIcono").attr("name", ("campoIcono" + cantidad));
        $(this).find(".campoIcono").attr("id", ("campoIcono" + cantidad));
        cantidad++;
    })
    $(".nonemove").find(".campoNombre").attr("name", ("campoNombre" + (cantidad-1)));
    $(".nonemove").find(".campoNombre").attr("id", ("campoNombre" + (cantidad-1)));
    $(".nonemove").find(".campoIcono").attr("name", ("campoIcono" + (cantidad-1)));
    $(".nonemove").find(".campoIcono").attr("id", ("campoIcono" + (cantidad-1)));
};

var equalName = function (element) {
    if (element.val() != "") {
        var count = 0;
        $(".campoNombre").each(function () {
            if ($(this).val().toUpperCase() == element.val().toUpperCase()) {
                count++;
            }
        });
        if (count > 1) {
            element.closest("td").attr('data-content', "El nombre que elegiste ya esta siendo usado. Escribe un nuevo nombre.");
            highlight(element, "danger");
            return true;
        }
        unhighlight(element, "danger");
        return false;
    }
};

var highlight = function (element, clase) {
    $('body').popover({
        html: true,
        trigger: 'manual',
        selector: '[data-toggle="popover"]',
        content: function () {
            return $(this).parent().find('.content').html();
        }
    });
    element.closest('td').popover('show');
    element.closest(".form-group").addClass("has-" + clase);
    element.addClass("form-control-" + clase);
};

var unhighlight = function (element, clase) {
    element.closest(".form-group").removeClass("has-" + clase);
    element.removeClass("form-control-" + clase);
    element.closest(".form-group").addClass("has-success");
    element.closest('td').popover('dispose');
};

var emptyValidation = function ($nombre, $rango) {
    if ($nombre.val() == 0 || $rango.val() == 0) {
        if ($nombre.val() == 0) {
            $nombre.closest("td").attr('data-content', "Debes ingresar el nombre para el logro.");
            highlight($nombre, "warning");
        } else {
            unhighlight($nombre, "warning");
        }
        if ($rango.val() == 0) {
            $rango.closest("td").attr('data-content', "Debes ingresar el valor máximo de puntos para este logro.");
            highlight($rango, "warning")
        } else {
            unhighlight($rango, "warning")
        }
        return true;
    }
    unhighlight($nombre, "warning");
    unhighlight($rango, "warning")
    return false;
}

var rangeValidation = function (rango) {
    if (rango.val() != 0) {
        var $before = rango.closest('tr').prev();
        var $after = rango.closest('tr').next();
        if (!$before.hasClass("hide") && !$after.hasClass("nonemove")) {
            if (
                parseInt(rango.val()) <= parseInt($before.find(".campoRango").val()) ||
                parseInt(rango.val()) >= parseInt($after.find(".campoRango").val())
            ) {
                rango.closest("td").attr('data-content', "Debes ingresar un valor mayor a " + $before.find(".campoRango").val() + " y menor a " + $after.find(".campoRango").val() + ".");
                highlight(rango, "danger");
                return true;
            }
        } else {
            if (!$before.hasClass("hide")) {
                if (
                    parseInt(rango.val()) <= parseInt($before.find(".campoRango").val())
                ) {
                    rango.closest("td").attr('data-content', "Debes ingresar un valor mayor a " + $before.find(".campoRango").val() + ".");
                    highlight(rango, "danger");
                    return true;
                }
            } else {
                if (!$after.hasClass("nonemove")) {
                    if (
                        parseInt(rango.val()) >= parseInt($after.find(".campoRango").val())
                    ) {
                        rango.closest("td").attr('data-content', "Debes ingresar un valor menor a " + $after.find(".campoRango").val() + ".");
                        highlight(rango, "danger");
                        return true;
                    }
                }
            }
        }
        unhighlight(rango, "danger");
        return false;
    }
    return false;
}

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
    changeForm();
    $("tr:nth-child(3)").find(".table-up").remove();
    $("tr:nth-last-child(2)").find(".table-down").remove();
    $("tr:nth-last-child(1)").find(".table-down").remove();
    $("tr:nth-last-child(1)").find(".table-up").remove();
};