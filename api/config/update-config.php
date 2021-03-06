<?php

//Poner las importaciones en el nivel donde se ejecute este código
include_once '../../database/conn.php';
include_once '../../database/db-functions.php';
include_once '../../helpers/functions.php';

$result = [];
if (isset($_POST['enviar'])) {
    try {
        //Recepcion de datos
        $bank = isset($_POST['bank']) ? $_POST['bank'] : null;
        $stakesPrincipales = isset($_POST['stakes']) ? $_POST['stakes'] : null;

        //---------------------- Validaciones ----------------------
        if ($bank == null || $bank['valorInicial'] == null || $bank['valorInicial'] == ""  || !is_numeric($bank['valorInicial']))
            throw new Exception("El valor inicial no es válido");

        if ($bank['porcentaje'] == null || $bank['porcentaje'] == ""  || !is_numeric($bank['porcentaje']))
            throw new Exception("El porcentaje no es válido");

        if (is_numeric($bank['porcentaje']) && $bank['porcentaje'] < 0)
            throw new Exception("El porcentaje no puede ser negativo");
        // -------------------- Fin Validaciones -------------------

        // -------------------- Procesamiento de datos -------------------
        $entityConfiguracion = [];
        $stakesPrincipalesString = "'";
        if ($stakesPrincipales == null || $stakesPrincipales == []) {
            $stakesPrincipalesString = 'NULL';
        } else {
            foreach ($stakesPrincipales as $stake) {
                $stakesPrincipalesString .= $stake . '-';
            }
            $stakesPrincipalesString .= "'";
        }

        $entityConfiguracion['stakesPrincipales'] =  $stakesPrincipalesString;
        // -------------------- Fin Procesamiento datos -------------------

        //------------------ Actualizacion de datos --------------------
        $resultBank = updateBankEntitie($conn, $bank);
        if (!$resultBank['success'])
            throw new Exception($resultBank['message']);

        $resultConfiguracion = updateConfiguracion($conn, $entityConfiguracion);
        if (!$resultConfiguracion['success'])
            throw new Exception($resultConfiguracion['message']);

        setRealBank($conn);

        //-------------- Actualizacion de datos --------------------
        $result['success'] = true;
        $result['message'] = "La configuración se ha actualizado correctamente";

        //----------------- Fin Actualizacion de datos --------------------


    } catch (Exception $e) {
        $msg = $e->getMessage();
        $result['success'] = false;
        $result['message'] = $msg;
    }
} else {
    $result = ['success' => false, 'message' => "No se han enviado los parametros correspondientes"];
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
