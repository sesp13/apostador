<?php
include_once 'db.php';
include_once 'db-functions.php';

if (isset($_POST['enviar'])) {
    //Recolectar los datos
    $descripcion = $_POST['descripcion'];
    $stake = $_POST['stake'];
    $cuota = $_POST['couta'];
    $valorStake = $_POST['valorStake'];

    $array = [
        'descripcion' => $descripcion,
        'idStake' => $stake,
        'couta' => $cuota,
        'valorStake' => $valorStake
    ];

    $msg = addBet($conn, $array);

    $bankActual = getBancoActual($conn) - floatval($array['valorStake']);
    
    updateBankAndStakes($conn,$bankActual);
    
    echo "
    <div class='alert alert-success'>$msg</div>
    ";

}
