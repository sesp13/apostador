<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <title>Banco de apuestas</title>
</head>

<body>
    <?php include_once 'db.php'; ?>
    <?php include_once 'db-functions.php'; ?>
    <div class="container mt-5">
        <a href="index.php">
            <h1>Banco de apuestas</h1>
        </a>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        Banco Inicial: <?php echo getBancoInicial($conn) ?>
                    </div>
                    <div class="col-12">
                        Banco Actual: <?php echo getBancoActual($conn) ?>
                    </div>
                    <div class="col-12">
                        Total en movimientos: <?php echo getRealMovements($conn) ?>
                    </div>
                    <div class="col-12">
                        Porcentaje del bank: <?php echo getPorcentaje($conn) ?> %
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <?php
                    $arrayStakes = getAllStakes($conn);
                    foreach ($arrayStakes as $stake) :
                    ?>
                        <div class="col-12">
                            <?php echo "{$stake['nombre']} - valor: {$stake['valor']}"; ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 mt-2">
                        <a href="logic/update-stakes.php" class="btn btn-primary" tooltip="Actualiza el valor de los stakes después de cambiar el valor del bank por db">
                            Corregir Bank
                        </a>
                    </div>
                </div>
            </div>
        </div>