"use strict";

$("#configForm").submit(function (event) {
  event.preventDefault();
  let boton = $(".botonSubmit");
  boton.attr("disabled", true);

  //Objeto
  let objeto = {
    bank: {
      valorInicial: $("#bancoInicial").val(),
      porcentaje: $("#porcentaje").val(),
    },
    enviar: true,
  };

  let successFunctionPost = function (response) {
    boton.attr("disabled", false);
    response = JSON.parse(response);
    if (response.success) {
      Swal.fire({
        title: "Éxito",
        icon: "success",
        text: response.message,
      }).then(() => {
        location.reload();
      });
    } else {
      boton.attr("disabled", false);
      Swal.fire({
        title: "Error",
        icon: "error",
        text: response.message,
      });
    }
  };

  let errorFunctionPost = function (error) {
    boton.attr("disabled", false);
    error = JSON.parse(error);
    Swal.fire({
      title: "Error",
      icon: "error",
      text: error.message,
    });
  };

  let urlPost = `${host}api/config/update-config.php`;

  hacerPeticion(
    urlPost,
    "POST",
    objeto,
    successFunctionPost,
    errorFunctionPost
  );
});
