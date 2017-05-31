$(document).ready(function() {

$('#city').select2({
  language: {
    noResults: function (params) {
      return "No se encontró la ciudad";
    }
  }
})});