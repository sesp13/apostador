"use strict";

//Seteado de los parametros de configuracion
let host = $("#host").text();
let urlGet = `${host}api/config/get-config.php`;

let successFunctionGet = function (response) {
  response = JSON.parse(response);
  if (response.success) {
    setConfig(response.message);
    setStakes(response.message);
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

function setStakes(entity) {
  let stakes = entity.stakes;
  let stakeSelector = $("#stakesPrincipalesSelect");

  //Procesamiento de stakes seleccionados
  let stakesSeleccionados = getStakesPrincipales(entity);
  
  let optionSeleccionado = "";
  stakes.forEach((element) => {
    optionSeleccionado = stakesSeleccionados.includes(element.id) ? "selected" : "";
    stakeSelector.append(
      `<option value="${element.id}" ${optionSeleccionado}>${element.nombre}</option>`
    );
  });

}

$(document).ready(function () {
  hacerPeticion(urlGet, "GET", {}, successFunctionGet, errorFunctionGet);
});
