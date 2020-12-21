$("#manage-bet-form").submit(function (event) {
  event.preventDefault();

  //Armado del objeto
  let apuesta = {
    descripcion: $("#descripcion").val(),
    idEstado: $("#idEstado").val(),
    valorFinal: $("#valorFinal").val(),
    valorStake: $("#valorStake").val(),
    cuota: $("#cuota").val(),
    fecha: $("#fecha").val(),
    tipo: $("#tipo").val(),
    id: $("#id").val(),
    enviar: true,
  };

  let successFunction = function (response) {
    response = JSON.parse(response);
    if (response.success) {
      Swal.fire({
        title: "Una ardilla ha editado la apuesta",
        icon: "success",
        text: response.message,
      }).then(() => {
        location.href = "index.php";
      });
    } else {
      Swal.fire({
        title: "Error",
        icon: "error",
        text: response.message,
      });
    }
  };

  let errorFunction = function (error) {
    error = JSON.parse(error);
    Swal.fire({
      title: "Error",
      icon: "error",
      text: error.message,
    });
  };

  let host = $("#host").text();
  let url = `${host}/api/update-bet.php`;
  hacerPeticion(url, "POST", apuesta, successFunction, errorFunction);
});
