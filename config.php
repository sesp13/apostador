<?php include_once './partials/header.php'; ?>
<h1 class="text-center mt-3">
    Configuración
</h1>
<p>Aquí podrás actualizar los parametros principales de tu aplicación, como por ejemplo cuantas bellotas escondes en el día, el colino para cepillarte los dientes y muchas cosas más, propias de la vida de una ardilla</p>
<hr>
<div class="form-section">
    <form class="form row" method="POST" id="configForm">
        <div class="form-group col-12 col-md-3">
            <label for="">Banco Inicial</label>
            <input type="number" name="bancoInicial" id="bancoInicial" class="form-control">
        </div>

        <div class="form-group col-12 col-md-2">
            <label for="">Porcentaje</label>
            <input type="number" step="any" name="porcentaje" id="porcentaje" class="form-control">
        </div>

        <div class="form-group col-md-7">
            <label for="">Stakes principales</label>
            <select name="stakesPrincipalesSelect" id="stakesPrincipalesSelect" class="form-control select-2" multiple>
            </select>
        </div>

        <div class="form-group col-12">
            <input type="submit" value="Actualizar" class="btn btn-success botonSubmit">
        </div>
    </form>
</div>
<?php include_once './partials/footer.php'; ?>
<script src="js/config/get-config.js"></script>
<script src="js/config/update-config.js"></script>