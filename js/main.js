"use strict";

$(document).ready(function () {
  //Funciones por defecto
  $(".select-2").select2();
  $(".hasTooltip").tooltip();

  let host = $("#host").text();

  let botonLogin = $("#loginModalButton");
  let lfCloseButton = $("#lf-close");
  lfCloseButton.hide();
  botonLogin.hide();

  if (!comprobarSesion()) {
    botonLogin.trigger("click");
  }

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
      if (valorOption == idOption) {
        $("#valorStake").val(valorStake);
      }
    });
  });

  $(".moneda").each(function () {
    let selector = $(this);
    let valorParseado = Intl.NumberFormat().format(selector.text().trim());
    selector.text(valorParseado);
  });

  let loginForm = $("#loginForm");

  loginForm.submit(function (e) {
    e.preventDefault();
    let correo = $("#lf-email").val();
    let contrasena = $("#lf-password").val();
    //Petición ajax
    $.ajax({
      type: "POST",
      url: `${host}/api/check-password.php`,
      data: {
        email: correo,
        password: contrasena,
      },
      success: function (response) {
        let data = JSON.parse(response);
        if (data.success) {
          localStorage.setItem("sesion", calcularFechaPosterior(10));
          alert(data.message);
          lfCloseButton.trigger("click");
        } else {
          alert(data.message);
        }
      },
    });
  });

  function comprobarSesion() {
    let sesion = localStorage.getItem("sesion");
    if (sesion != null) {
      let hoy = new Date();
      let fechaSesion = new Date(parseInt(sesion));
      if (hoy > fechaSesion) {
        localStorage.removeItem("sesion");
        return false;
      } else {
        return true;
      }
    } else {
      return false;
    }
  }

  function calcularFechaPosterior(dias) {
    let hoy = new Date();
    let diasCalulados = 1000 * 60 * 60 * 24 * dias;
    let suma = hoy.getTime() + diasCalulados;

    return suma;
  }

  //Manejos de stakes principales
  let stakesHeaderSelector = $(".stake-col");
  stakesHeaderSelector.hide();

  let urlStakesPrincipales = `${host}api/config/get-config.php`;
  let stakesPrincipales = [];
  hacerPeticion(
    urlStakesPrincipales,
    "GET",
    {},
    function (response) {
      response = JSON.parse(response);
      if (response.success) {
        let entity = response.message;
        stakesPrincipales = getStakesPrincipales(entity);
        stakesPrincipales.forEach((id) => {
          $(`#stake-${id}`).show();
        });
      }
    },
    function (error) {
      console.log(error);
    }
  );

  $(".showStakesButton").click(function () {
    let selector = $(this);
    let state = selector.attr("show");
    if (state == "true") {
      stakesHeaderSelector.show();
      selector.html("Mostrar los stakes principales");
      selector.attr("show", "false");
    } else {
      stakesHeaderSelector.hide();
      stakesPrincipales.forEach((id) => {
        $(`#stake-${id}`).show();
      });
      selector.html("Mostrar todos los stakes");
      selector.attr("show", "true");
    }
  });
});
