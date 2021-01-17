<?php
//Poner las importaciones en el nivel donde se ejecute este código
include_once '../../database/conn.php';
include_once '../../database/db-functions.php';
include_once '../../helpers/functions.php';

$result = [];

$bank = getBank($conn);

$messageApi = ['bank' => $bank];

$result = ['success' => true,  'message' => $messageApi];

echo json_encode($result, JSON_UNESCAPED_UNICODE);
