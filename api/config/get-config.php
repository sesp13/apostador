<?php
//Poner las importaciones en el nivel donde se ejecute este código
include_once '../../database/conn.php';
include_once '../../database/db-functions.php';
include_once '../../helpers/functions.php';

$result = [];

$bank = getBank($conn);
$stakes = getAllStakes($conn);
$configuracion = getConfiguracion($conn);

$messageApi = ['bank' => $bank, 'stakes' => $stakes, 'configuracion' => $configuracion];

$result = ['success' => true,  'message' => $messageApi];

echo json_encode($result, JSON_UNESCAPED_UNICODE);
