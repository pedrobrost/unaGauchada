var editando = false;
var last = null;

$(".submit").on("click", function(e) {
  $(this).closest("tr").find("input").prop("readonly", true);
  $(this).closest("tr").find(".editable").hide();
  $(this).closest("tr").find(".botones").show();
  editando = false;
  if ((btnAgregar = true)) {
    $(".table-add").show();
    btnAgregar = false;
  }
});

$(".edit").on("click", function(e) {
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

$(".editCancel").on("click", function(e) {
  $(this).closest("tr").find("input").prop("readonly", true);
  $(this).closest("tr").find(".editable").hide();
  $(this).closest("tr").find(".botones").show();
  editando = false;
  if ((btnAgregar = true)) {
    $(".table-add").show();
    btnAgregar = false;
    $clone.remove();
  }
});

var $TABLE = $("#logros");
var btnAgregar = false;
var $clone;
$(document).ready(function() {
  $("#mySubmissions").addClass("active");
  $(".editable").hide();
  $("input").prop("readonly", true);
  $TABLE.find("tr.hide").hide();
});

$("td").on("keydown paste", function(event) {
  //Prevent on paste as well
  if ($(this).text().length === 10 && event.keyCode != 8) {
    event.preventDefault();
  }
});

$("#range").keypress(function(e) {
  if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
});

$(".table-add").click(function() {
  $clone = $TABLE.find("tr.hide").clone(true).removeClass("hide table-line");
  $clone.show();
  $clone.find("input").prop("readonly", false);
  $clone.find(".edit").trigger("click");
  last = $clone;
  $clone.insertBefore( $TABLE.find("tr.hide") );
  $(".table-add").hide();
  btnAgregar = true;
  editando = true;
});

$(".table-remove").click(function() {
  $(this).parents("tr").detach();
});

$(".table-up").click(function() {
  var $row = $(this).parents("tr");
  if ($row.index() === 1) return; // Don't go above the header
  $row.prev().before($row.get(0));
});

$(".table-down").click(function() {
  var $row = $(this).parents("tr");
  if ($row.next().hasClass( "nonemove" )) return;
  $row.next().after($row.get(0));
});
