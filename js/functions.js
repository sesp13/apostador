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
