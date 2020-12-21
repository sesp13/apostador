$("#add-bet-form").submit(function (event) {
  event.preventDefault();

  //Armado del objeto
  let apuesta = {
    descripcion: $("#descripcion").val(),
    stake: $("#stake-select").val(),
    cuota: $("#cuota").val(),
    valorStake: $("#valorStake").val(),
    enviar: true,
  };

  let successFunction = function (response) {
    response = JSON.parse(response);
    if (response.success) {
      Swal.fire({
        title: "Una ardilla ha agregado una apuesta",
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
  let url = `${host}/api/add-bet.php`;

  hacerPeticion(url, "POST", apuesta, successFunction, errorFunction);
});
