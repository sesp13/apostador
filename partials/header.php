<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Banco de apuestas</title>
</head>

<body>
    <?php include_once 'db.php'; ?>
    <?php include_once 'db-functions.php'; ?>
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
                        <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
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

        <a href="index.php">
            <h1>Banco de apuestas</h1>
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
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="row">
                    <?php
                    $arrayStakes = getAllStakes($conn);
                    foreach ($arrayStakes as $stake) :
                    ?>
                        <div class="col-12">
                            <?php echo "{$stake['nombre']} - valor: <span class='moneda'>{$stake['valor']}"; ?> </span>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 mt-2">
                        <a href="logic/update-stakes.php" class="btn btn-primary" tooltip="Actualiza el valor de los stakes después de cambiar el valor del bank por db">
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