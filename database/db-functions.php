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

function updateBankAndStakes($conn, $bankActual)
{
    updateBank($conn, $bankActual);
    $bank = getBank($conn);

    $arrayStakes = getAllStakes($conn);

    foreach ($arrayStakes as $stake) {
        //Calcular el stake nuevo
        $porcentaje = $bank['porcentaje'];
        $multiplicador = $stake['multiplicador'];
        $valorActual = $bank['valorActual'];

        if ($multiplicador > 1) {
            $porcentajeNuevo = $multiplicador - 1 + $porcentaje;
        } else {
            $porcentajeNuevo = $multiplicador * $porcentaje;
        }

        updateStake($conn, [
            'id' => $stake['id'],
            'valor' => $valorActual * $porcentajeNuevo / 100,
        ]);
    }
}

function setRealBank($conn)
{
    $contador = getRealMovements($conn);
    $valorReal = getBancoInicial($conn) + $contador;
    updateBankAndStakes($conn, $valorReal);
}

function getRealMovements($conn)
{
    $consulta = "SELECT valorStake, valorFinal FROM apuesta";
    $resultado = mysqli_query($conn, $consulta);
    $contador = 0;

    while ($row = mysqli_fetch_assoc($resultado)) {
        $valorStake = $row['valorStake'];
        $valorFinal = $row['valorFinal'];
        $valorFinal = $valorFinal == '' || $valorFinal == null ? 0 : $valorFinal;
        $contador += $valorFinal - $valorStake;
    }

    return $contador;
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
function getAllBets($conn, $limit = null)
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

    if (isset($limit)) {
        $consulta .= "LIMIT $limit";
    }

    $resultado = mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_assoc($resultado)) {

        $estado = $row['idEstado'];
        if ($estado == 1) {
            $clase = "color-primary";
        } else if ($estado == 2) {
            $clase = "color-green";
        } else if ($estado == 3) {
            $clase = "color-red";
        } else {
            $clase = "";
        }


        array_push($array, [
            'id' => $row['id'],
            'descripcion' => utf8_encode($row['descripcion']),
            'idEstado' => $row['idEstado'],
            'estado' => $row['estado'],
            'idStake' => $row['idStake'],
            'stake' => $row['stake'],
            'cuota' => $row['cuota'],
            'valorStake' => $row['valorStake'],
            'valorFinal' => $row['valorFinal'],
            'fecha' => $row['fecha'],
            'clase' => $clase
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
    $descripcion = utf8_decode($array['descripcion']);
    $consulta = "
    INSERT INTO apuesta(descripcion,idEstado,idStake,cuota,valorStake,fecha)
    VALUES(
        '$descripcion',
        1,
        {$array['idStake']},
        {$array['couta']},
        {$array['valorStake']},
        CURDATE()
    )
    ";

    $resultado = mysqli_query($conn, $consulta);
    if ($resultado) {
        return ['success' => true, 'message' => 'Inserción de datos correcta'];
    } else {
        return ['success' => false, 'message' => 'error' . mysqli_error($conn)];
    }
}

function updateBet($conn, $array)
{
    $consulta = "
    UPDATE apuesta SET
    descripcion = '{$array['descripcion']}',
    idEstado = {$array['idEstado']},
    valorFinal = {$array['valorFinal']},
    valorStake = {$array['valorStake']},
    fecha = '{$array['fecha']}',
    cuota = {$array['cuota']}
    WHERE id = {$array['id']}
    ";
    $resultado = mysqli_query($conn, $consulta);
    if ($resultado) {
        return ['success' => true, 'message' => 'La apuesta se ha editado correctamente'];
    } else {
        return ['success' => false, 'message' => 'error' . mysqli_error($conn)];
    }
}

function countLostBets($conn)
{
    $consulta = "
    SELECT COUNT(id) as 'Numero'
    FROM apuesta
    WHERE idEstado = 3
    ";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);
    return $array['Numero'];
}

function countWonBets($conn)
{
    $consulta = "
    SELECT COUNT(id) as 'Numero'
    FROM apuesta
    WHERE idEstado = 2
    ";
    $resultado = mysqli_query($conn, $consulta);
    $array = mysqli_fetch_assoc($resultado);
    return $array['Numero'];
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

//Corregir mal formato de datos en la base de datos
function corregirEncode($conn)
{
    $apuestas = getAllBets($conn);
    foreach ($apuestas as $apuesta) {
        $descripcion = utf8_decode($apuesta['descripcion']);
        $consulta = "UPDATE apuesta SET descripcion = '$descripcion' WHERE id = {$apuesta['id']}";
        $resultado = mysqli_query($conn, $consulta);
    }
}


//Funciones de usuario
function getUser($conn, $email)
{
    $array = [];
    $consulta = "
    SELECT * FROM usuario WHERE correo = '$email' LIMIT 1
    ";
    $resultado = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($resultado);
    return $row;
}
