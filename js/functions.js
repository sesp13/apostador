function hacerPeticion(
  url,
  tipo,
  objeto,
  callSuccessBackFuction,
  callbackErrorFunction
) {
  $.ajax({
    type: tipo,
    url: url,
    data: objeto,
    success: (response) => callSuccessBackFuction(response),
    error: (error) => callbackErrorFunction(error),
  });
}

//Regresa un arreglo con los ids de los stakes principales
function getStakesPrincipales(entity) {
  let stakesSeleccionados = entity.configuracion.stakesPrincipales;
  stakesSeleccionados = stakesSeleccionados == null ? "" : stakesSeleccionados;
  stakesSeleccionados = stakesSeleccionados.split("-");
  return stakesSeleccionados;
}
