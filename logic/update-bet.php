<?php
//Poner las importaciones en el nivel donde se ejecute este código
include_once 'db.php';
include_once 'db-functions.php';
include_once 'helpers/functions.php';
$showAlert = false;
$msg = '';

if (isset($_POST['enviar'])) {
    //Recolectar los datos
    $descripcion = codificarString($_POST['descripcion']);
    $idEstado = $_POST['idEstado'];
    $valorFinal = $_POST['valorFinal'] != null && $_POST['valorFinal'] != '' ? $_POST['valorFinal'] : 'NULL';
    $valorStake = $_POST['valorStake'];
    $cuota = $_POST['cuota'];
    $fecha = $_POST['fecha'];
    $tipo = $_POST['tipo'];
    $id = $_POST['id'];

    $array = [
        'descripcion' => $descripcion,
        'idEstado' => $idEstado,
        'valorFinal' => $valorFinal,
        'valorStake' => $valorStake,
        'fecha' => $fecha,
        'id' => $id,
        'cuota' => $cuota   
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
