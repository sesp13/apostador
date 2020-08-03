<?php
include_once 'db.php';
include_once 'db-functions.php';

if (isset($_POST['enviar'])) {
    //Recolectar los datos
    $descripcion = $_POST['descripcion'];
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

    $msg = updateBet($conn,$array);
    
    $bankActual = getBancoActual($conn);

    if($tipo == "0"){
        $bankActual = $bankActual + floatval($valorFinal);
    }  else {
        $bankActual = $bankActual - floatval($valorStake) + floatval($valorFinal);
    }

    updateBankAndStakes($conn,$bankActual);
    echo "
    <div class='alert alert-success'>$msg</div>
    ";
}