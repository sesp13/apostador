<?php
include_once '../database/conn.php';
include_once '../database/db-functions.php';
include_once '../helpers/functions.php';


if (isset($_POST['enviar'])) {
    //Recolectar los datos
    $descripcion = utf8_encode($_POST['descripcion']);
    $stake = $_POST['stake'];
    $cuota = $_POST['cuota'];
    $valorStake = $_POST['valorStake'];

    //Variable de control para el despliegue de la respuesta
    $hasResponse = false;

    //Validaciones
    if ($descripcion == null || $descripcion == "") {
        $result = ['success' => false, 'message' => 'La descripción no puede ser nula'];
        $hasResponse = true;
    }

    if (($cuota == null || $cuota == ""  || !is_numeric($cuota)) && !$hasResponse) {
        $result = ['success' => false, 'message' => 'El valor de la cuota no es válido'];
        $hasResponse = true;
    }

    if (!$hasResponse) {
        $array = [
            'descripcion' => $descripcion,
            'idStake' => $stake,
            'couta' => $cuota,
            'valorStake' => $valorStake
        ];

        $msg = addBet($conn, $array);

        if ($msg['success']) {
            $bankActual = getBancoActual($conn) - floatval($array['valorStake']);
            updateBankAndStakes($conn, $bankActual);
            $result = ['success' => true, 'message' => $msg['message']];
        } else {
            $result = ['success' => false, 'message' => $msg['message']];
        }
    }
} else {
    $result = ['success' => false, 'message' => $msg];
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
