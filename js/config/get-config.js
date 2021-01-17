"use strict";

//Seteado de los parametros de configuracion
let host = $("#host").text();
let urlGet = `${host}/api/config/get-config.php`;

let successFunctionGet = function (response) {
  response = JSON.parse(response);
  if (response.success) {
    setConfig(response.message);
  } else {
    location.href = "index.php";
  }
};

let errorFunctionGet = function (error) {
  location.href = "index.php";
};

function setConfig(entity) {
  let bank = entity.bank;
  let valorInicialSelector = $("#bancoInicial");
  let porcentajeSelector = $("#porcentaje");
  valorInicialSelector.val(bank.valorInicial);
  porcentajeSelector.val(bank.porcentaje);
}

$(document).ready(function () {
  hacerPeticion(urlGet, "GET", {}, successFunctionGet, errorFunctionGet);
});
