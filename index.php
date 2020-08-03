<?php include_once 'partials/header.php' ?>
<div class="container mt-5">
    <h1>Banco de apuestas</h1>
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
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <a href="add-bet.php" class="btn btn-success">Agregar apuesta</a>
        </div>
        <div class="col-12 mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Stake</th>
                        <th>Cuota</th>
                        <th>Valor stake</th>
                        <th>Estado</th>
                        <th>Valor final</th>
                        <th>Ganancia</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $arrayApuestas = getAllBets($conn);
                    foreach ($arrayApuestas as $apuesta) :
                    ?>
                        <tr>
                            <th>
                                <?php echo $apuesta['id']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['descripcion']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['stake']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['cuota']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['valorStake']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['estado']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['valorFinal']; ?>
                            </th>
                            <th>
                                <?php echo $apuesta['valorFinal'] != null ? $apuesta['valorFinal'] - $apuesta['valorStake'] : "" ?>
                            </th>
                            <th>
                                <?php echo $apuesta['fecha']; ?>
                            </th>
                            <th>
                                <a href="manage-bet.php?id=<?php echo $apuesta['id']; ?>" class="btn btn-warning">Gestionar</a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php' ?>