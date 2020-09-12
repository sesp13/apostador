<?php
include_once 'db.php';
include_once 'db-functions.php';
include_once 'helpers/functions.php';
include_once 'helpers/global-info.php';

$array = [];
if (isset($_POST)) {

    $user = getUser($conn, $_POST['email']);

    if ($user == null || $user == []) {
        $array['success'] = false;
        $array['status'] = 400;
        $array['message'] = "No se ha encontrado a ningún usuario";
    } else {
        $array['success'] = password_verify($_POST['password'], $user['contrasena']) ? true : false;
        if ($array['success']) {
            $array['message'] = "Login exitoso";
            $array['status'] = 200;
        } else {
            $array['message'] = "Contraseña incorrecta";
            $array['status'] = 400;
        }
    }


    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}
