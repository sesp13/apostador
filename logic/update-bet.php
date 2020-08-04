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

    $msg = updateBet($conn, $array);

    $bankActual = getBancoActual($conn);
    $apuesta = getBetById($conn, $id);

    if ($tipo == "0") {
        $bankActual = $bankActual + floatval($valorFinal);
    } else {
        $movimientoAnterior =  abs(floatval($apuesta['valorFinal']) - floatval($apuesta['valorStake']));
        $gananciaNueva = floatval($valorFinal) - floatval($valorStake);
        if ($apuesta['idEstado'] == '2') {
            $bankActual =  $bankActual - $movimientoAnterior + $gananciaNueva;
        }
        if ($apuesta['idEstado'] == '3') {
            $bankActual = $bankActual + $movimientoAnterior + $gananciaNueva;
        }
        if ($apuesta['idEstado'] = '4') {
            $bankActual = $bankActual + $gananciaNueva;
        }
    }

    updateBankAndStakes($conn, $bankActual);
    echo "
    <div class='alert alert-success'>$msg</div>
    ";
}
