<?php
include_once 'db.php';
include_once 'db-functions.php';
$showAlert = false;
$msg = '';

if (isset($_POST['enviar'])) {
    //Recolectar los datos
    $descripcion = utf8_decode($_POST['descripcion']);
    $idEstado = $_POST['idEstado'];
    $valorFinal = $_POST['valorFinal'];
    $valorStake = $_POST['valorStake'];
    $fecha = $_POST['fecha'];
    $tipo = $_POST['tipo'];
    $id = $_POST['id'];

    $array = [
        'descripcion' => $descripcion,
        'idEstado' => $idEstado,
        'valorFinal' => $valorFinal,
        'fecha' => $fecha,
        'id' => $id
    ];

    $msg = updateBet($conn, $array);

    $bankActual = getBancoActual($conn);
    $apuesta = getBetById($conn, $id);

    if ($tipo == "0") {
        $bankActual = $bankActual + floatval($valorFinal);
        updateBankAndStakes($conn, $bankActual);
    } else {
        setRealBank($conn);
    }

    $showAlert = true;
}
