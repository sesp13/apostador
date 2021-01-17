<?php include_once 'partials/header.php';
include_once './logic/bet-pagination.php';
?>
<div class="row mt-2">
    <div class="col-12">
        <a href="add-bet.php" class="btn btn-success">Agregar apuesta</a>
    </div>
    <div class="col-12 mt-2">
        <h1 class="text-right">Listado de nueces</h1>
    </div>
    <div class="col-12 mt-3">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripción</th>
                    <th style="width: 90px;">Stake</th>
                    <th>Cuota</th>
                    <th>Valor stake</th>
                    <th>Estado</th>
                    <th>Valor final</th>
                    <th>Ganancia</th>
                    <th class="contenedor-fecha">Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $arrayApuestas = getBetsPaginated($conn, $start, $itemsPerPage);
                foreach ($arrayApuestas as $apuesta) :
                ?>
                    <tr>
                        <th>
                            <?php echo $apuesta['id']; ?>
                        </th>
                        <th class="text-left">
                            <?php echo decodificarString($apuesta['descripcion']); ?>
                        </th>
                        <th>
                            <?php echo $apuesta['stake']; ?>
                        </th>
                        <th>
                            <?php echo $apuesta['cuota']; ?>
                        </th>
                        <th class="moneda">
                            <?php echo $apuesta['valorStake']; ?>
                        </th>
                        <th class="<?php echo $apuesta['clase']; ?>">
                            <?php echo $apuesta['estado']; ?>
                        </th>
                        <th class="moneda">
                            <?php echo $apuesta['valorFinal']; ?>
                        </th>
                        <th class="moneda <?php echo $apuesta['clase']; ?>">
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
<?php createPaginator($total_pages, $page) ?>
</div>
<?php include_once 'partials/footer.php' ?>