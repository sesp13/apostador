<?php include_once 'partials/header.php' ?>
<h2 class="text-center mt-3">
    Agregar apuesta
</h2>
<?php include_once 'logic/add-bet.php' ?>
<div class="form-section">
    <form class="form row" method="POST">
        <div class="form-group col-12">
            <label for="">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
        <div class="form-group col-6">
            <label for="">Stake</label>
            <?php $arrayStakes = getAllStakes($conn); ?>
            <select class="form-control" name="stake" id="stake-select">
                <?php foreach ($arrayStakes as $stake) : ?>
                    <option value="<?php echo $stake['id'] ?>" stake="<?php echo $stake['valor'] ?>" class="option-stake">
                        <?php echo $stake['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-6">
            <label for="">Cuota</label>
            <input type="text" name="couta" id="cuota" class="form-control">
        </div>
        <div class="form-group col-6">
            <label for="">Valor Stake</label>
            <input type="text" name="valorStake" id="valorStake" class="form-control" value="<?php echo $arrayStakes[0]['valor'] ?>">
        </div>
        <div class="form-group col-12">
            <input type="submit" class="btn btn-success" name="enviar" value="Agregar">
        </div>
    </form>
</div>
<?php include_once 'partials/footer.php' ?>