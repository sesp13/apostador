"use strict";

$(document).ready(function () {
  $("#idEstado").change(function () {
    var elemento = $(this);
    var valor = elemento.val();
    var cuota = parseFloat($("#cuota").val());
    var valorStake = parseFloat($("#valorStake").val());

    var valorFinal = $("#valorFinal");

    switch (valor) {
      case "2":
        valorFinal.val(valorStake * cuota);
        break;
      case "3":
        valorFinal.val(0);
        break;
      case "4":
        valorFinal.val(valorStake);
        break;
      default:
        break;
    }
  });

  $("#stake-select").change(function () {
    var idOption = $(this).val();
    $(".option-stake").each(function () {
      var elemento = $(this);
      var valorOption = elemento.attr("value");
      var valorStake = elemento.attr("stake");
      if(valorOption == idOption){
        $("#valorStake").val(valorStake);
      }
    });
  });
});
