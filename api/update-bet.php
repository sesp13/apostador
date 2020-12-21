<?php
//Poner las importaciones en el nivel donde se ejecute este código
include_once '../database/conn.php';
include_once '../database/db-functions.php';
include_once '../helpers/functions.php';

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

    //Variable de control para el despliegue de la respuesta
    $hasResponse = false;

    //-----------------------   Validaciones  -------------------------------
    if ($descripcion == null || $descripcion == "") {
        $result = ['success' => false, 'message' => 'La descripción no puede ser nula'];
        $hasResponse = true;
    }

    if (($cuota == null || $cuota == ""  || !is_numeric($cuota)) && !$hasResponse) {
        $result = ['success' => false, 'message' => 'El valor de la cuota no es válido'];
        $hasResponse = true;
    }

    if (($fecha == null || $fecha == "") && !$hasResponse) {
        $result = ['success' => false, 'message' => 'El valor de la Fecha no es válido'];
        $hasResponse = true;
    }

    if (($valorStake == null || $valorStake == ""  || !is_numeric($valorStake)) && !$hasResponse) {
        $result = ['success' => false, 'message' => 'El valor del stake no es válido'];
        $hasResponse = true;
    }

    //----------------------    Fin Validaciones  -----------------------------------

    if (!$hasResponse) {
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

        if ($msg['success']) {
            $bankActual = getBancoActual($conn);
            $apuesta = getBetById($conn, $id);

            if ($tipo == "0") {
                $bankActual = $bankActual + floatval($valorFinal);
                updateBankAndStakes($conn, $bankActual);
            } else {
                setRealBank($conn);
            }
            $result = ['success' => true, 'message' => $msg['message']];
        } else {
            $result = ['success' => false, 'message' => $msg['message']];
        }
    }
} else {
    $result = ['success' => false, 'message' => $msg];
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
