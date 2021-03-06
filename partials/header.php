<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link href="css/imports/select2.min.css" rel="stylesheet" />
    <title>Banco de apuestas</title>
</head>

<body>
    <?php include_once 'database/conn.php'; ?>
    <?php include_once 'database/db-functions.php'; ?>
    <?php include_once 'helpers/functions.php'; ?>
    <?php include_once 'helpers/global-info.php'; ?>
    <p id="host"><?php echo $HOST ?></p>

    <div class="container mt-5">
        <!-- Modal de login -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" id="loginModalButton">
            Modal
        </button>

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Banco de apuestas: Iniciar sesión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="lf-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-section">
                            <form id="loginForm" class="form row" method="POST">
                                <div class="form-group col-12">
                                    <label>Correo</label>
                                    <input type="email" name="lf-email" id="lf-email" class="form-control" required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Contraseña</label>
                                    <input type="password" name="lf-password" id="lf-password" class="form-control" required>
                                </div>
                                <div class="form-group col-12">
                                    <input type="submit" value="Enviar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="index.php" id="logo">
            Banco de apuestas
        </a>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12">
                        Banco Inicial: <span class="moneda"> <?php echo getBancoInicial($conn) ?> </span>
                    </div>
                    <div class="col-12">
                        Banco Actual: <span class="moneda"> <?php echo getBancoActual($conn) ?> </span>
                    </div>
                    <div class="col-12">
                        Total en movimientos: <span class="moneda"> <?php echo getRealMovements($conn) ?> </span>
                    </div>
                    <div class="col-12">
                        Porcentaje del bank: <span class="moneda"> <?php echo getPorcentaje($conn) ?></span> %
                    </div>
                    <div class="col-12">
                        <?php if (basename($_SERVER['PHP_SELF']) == 'config.php') : ?>
                            <a href="index.php" class="btn btn-dark">Inicio</a>
                        <?php else : ?>
                            <a href="config.php" class="btn btn-dark hasTooltip" show="true" data-toggle="tooltip" data-placement="right" title="En esta página podrás modificar los datos generales de la aplicación">
                                Configuración
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="row">
                    <?php
                    $arrayStakes = getAllStakes($conn);
                    foreach ($arrayStakes as $stake) :
                    ?>
                        <div class="col-12 stake-col" id="stake-<?php echo $stake['id'] ?>">
                            <?php echo "{$stake['nombre']} - valor: <span class='moneda'>{$stake['valor']}"; ?> </span>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 mt-2">
                        <button class="btn btn-warning mb-2 d-none d-lg-block showStakesButton hasTooltip" id="showStakesButton" show="true" data-toggle="tooltip" data-placement="right" title="Muestra o no el valor de tus stakes en el encabezado de la página, los valores a mostrar los puedes configurar en el menú de configuración">
                            Mostrar todos los stakes
                        </button>
                        <!-- Boton responsive -->
                        <button class="btn btn-warning d-lg-none hasTooltip showStakesButton mb-2" id="showStakesButtonR" show="true">
                            Mostrar todos los stakes
                        </button>
                        <a href="logic/update-stakes.php" class="btn btn-primary hasTooltip mb-2" data-toggle="tooltip" data-placement="right" title="Sirve para corregir descuadres en el bank y los stakes dando como resultado los movimientos reales">
                            Corregir Bank
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        Apuestas ganadas: <?php echo countWonBets($conn); ?>
                    </div>
                    <div class="col-12">
                        Apuestas perdidas: <?php echo countLostBets($conn); ?>
                    </div>
                </div>
            </div>
        </div>