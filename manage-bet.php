<?php include_once 'partials/header.php' ?>
<?php
include_once 'logic/update-bet.php';
$apuesta = getBetById($conn, $_GET['id']);
?>
<div class="container mt-5">
    <a href="index.php">
        <h1>Banco de apuestas</h1>
    </a>
    <h2 class="text-center mt-3">
        Gestionar apuesta
    </h2>
    <div class="form-section">
        <form class="form row" method="POST">
            <div class="form-group col-12">
                <label for="">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"><?php echo $apuesta['descripcion'] ?></textarea>
            </div>
            <div class="form-group col-6">
                <label for="">Estado</label>
                <?php $arrayState = getAllStates($conn); ?>
                <select class="form-control" name="idEstado" id="idEstado">
                    <?php foreach ($arrayState as $state) : ?>
                        <option value="<?php echo $state['id'] ?>">
                            <?php echo $state['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="">Id</label>
                <input type="text" class="form-control" value="<?php echo $apuesta['id'] ?>" disabled>
                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $apuesta['id'] ?>">
            </div>
            <div class="form-group col-6">
                <label for="">Cuota</label>
                <input type="text" name="cuota" id="cuota" class="form-control" value="<?php echo $apuesta['cuota'] ?>" disabled>
            </div>
            <div class="form-group col-6">
                <label for="">Valor stake</label>
                <input type="text" name="valorStake" id="valorStake" class="form-control" value="<?php echo $apuesta['valorStake'] ?>" disabled>
            </div>
            <div class="form-group col-6">
                <label for="">Valor Final</label>
                <input type="text" name="valorFinal" id="valorFinal" class="form-control" value="<?php echo $apuesta['valorFinal'] ?>">
            </div>
            <div class="form-group col-6">
                <label for="">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $apuesta['fecha'] ?>">
            </div>
            <div class="form-group col-12">
                <input type="submit" class="btn btn-success" name="enviar" value="Actualizar">
            </div>
        </form>
    </div>
</div>