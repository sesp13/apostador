<?php

// Funciones del bank

function getBancoInicial($conn)
{
    $consulta = "SELECT valorInicial FROM banco WHERE id = 1";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);

    return $array['valorInicial'];
}

function getBancoActual($conn)
{
    $consulta = "SELECT valorActual FROM banco WHERE id = 1";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);

    return $array['valorActual'];
}

function getBank($conn)
{
    $consulta = "SELECT * FROM banco WHERE id = 1";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);

    return $array;
}

function updateBank($conn, $valor)
{
    $consulta = "UPDATE banco SET valorActual = $valor WHERE id = 1";
    $resultado = mysqli_query($conn, $consulta);
}

function getPorcentaje($conn)
{
    $consulta = "SELECT porcentaje FROM banco WHERE id = 1";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);

    return $array['porcentaje'];
}

function updateBankAndStakes($conn,$bankActual)
{
    updateBank($conn, $bankActual);
    $bank = getBank($conn);

    $arrayStakes = getAllStakes($conn);

    foreach ($arrayStakes as $stake) {
        updateStake($conn, [
            'id' => $stake['id'],
            'valor' => $stake['multiplicador'] * $bank['valorActual'] * $bank['porcentaje'] / 100,
        ]);
    }
}

//Funciones del stake

function getAllStakes($conn)
{
    $array = [];
    $consulta = "SELECT * FROM stake";
    $resultado = mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($array, [
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'valor' => $row['valor'],
            'multiplicador' => $row['multiplicador']
        ]);
    }

    return $array;
}

function updateStake($conn, $array)
{
    $consulta = "UPDATE stake SET valor = {$array['valor']} WHERE id = {$array['id']}";
    $resultado = mysqli_query($conn, $consulta);
}


//Funciones de apuestas
function getAllBets($conn)
{
    $array = [];
    $consulta = "
    SELECT 
    estado.nombre as 'estado',
    stake.nombre as 'stake',
    apuesta.*
    FROM apuesta apuesta
    INNER JOIN stake stake ON apuesta.idStake = stake.id
    INNER JOIN estado estado ON apuesta.idEstado = estado.id
    ORDER BY apuesta.id DESC
    ";
    $resultado = mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($array, [
            'id' => $row['id'],
            'descripcion' => $row['descripcion'],
            'idEstado' => $row['idEstado'],
            'estado' => $row['estado'],
            'idStake' => $row['idStake'],
            'stake' => $row['stake'],
            'cuota' => $row['cuota'],
            'valorStake' => $row['valorStake'],
            'valorFinal' => $row['valorFinal'],
            'fecha' => $row['fecha']
        ]);
    }

    return $array;
}

function getBetById($conn, $id)
{
    $array = [];
    $consulta = "
    SELECT * FROM apuesta WHERE id = $id
    ";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);

    return $array;
}


function addBet($conn, $array)
{
    $consulta = "
    INSERT INTO apuesta(descripcion,idEstado,idStake,cuota,valorStake,fecha)
    VALUES(
        '{$array['descripcion']}',
        1,
        {$array['idStake']},
        {$array['couta']},
        {$array['valorStake']},
        CURDATE()
    )
    ";

    $resultado = mysqli_query($conn, $consulta);
    if ($resultado) {
        return 'Inserción de datos correcta';
    } else {
        return 'error' . mysqli_error($conn);
    }
}

function updateBet($conn, $array)
{
    $consulta = "
    UPDATE apuesta SET
    descripcion = '{$array['descripcion']}',
    idEstado = {$array['idEstado']},
    valorFinal = {$array['valorFinal']},
    fecha = '{$array['fecha']}'
    WHERE id = {$array['id']}
    ";
    $resultado = mysqli_query($conn, $consulta);
    if ($resultado) {
        return 'Actualización de datos correcta';
    } else {
        return 'error' . mysqli_error($conn);
    }
}

//Funciones de Estado
function getAllStates($conn)
{
    $array = [];
    $consulta = "
    SELECT * FROM estado
    ";
    $resultado = mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($array, [
            'id' => $row['id'],
            'nombre' => $row['nombre']
        ]);
    }
    return $array;
}
