<?php

//Base de datos local
// $conn = mysqli_connect('localhost','root','','apostador');

//Base de datos remota
// $conn = mysqli_connect('www.db4free.net','sesp13','hw36NMz*nzD3AE#','apostador');

//Clever cloud  
//Host-User-Pass-DB
// $conn = mysqli_connect('byrvzgxbut1hzitzlhub-mysql.services.clever-cloud.com','um1qciqnpista0gu','iNdGbs0TxklBCmKXAJAe','byrvzgxbut1hzitzlhub');
//Clever cloud Dienton 
$conn = mysqli_connect('bfwhtkmbrodfsbquyygf-mysql.services.clever-cloud.com','ukbnaz5tatiaswmy','zbn6bkIQYM4opcqYAkzt','bfwhtkmbrodfsbquyygf');

//Comprobar la conexión
// if(mysqli_connect_errno()){
//   echo 'Error al conectar a la base de datos'.mysqli_connect_error().'<br>';
// }else{
//   echo 'Conexión exitosa!!! <br>';
// }

// //consulta para configurar la codificacion de caracteres
// mysqli_query($conn, "SET NAMES 'utf8'");

// //Consulta select desde php
// $query = mysqli_query($conn,"SELECT * FROM  notas");
// while($nota = mysqli_fetch_assoc($query)){
//   echo $nota['titulo'].'<br>';
//   echo $nota['descripcion'].'<br>';
// }

// //Inserción de datos desde de php
// $sql ="INSERT INTO notas VALUES(null,'Nota desde PHP','Esto es una nota desde PHP','green')";
// $insert = mysqli_query($conn,$sql);

// if($insert){
//   echo 'Inserción de datos correcta';
// }
// else{
//   echo 'error'.mysqli_error($conn);
// }

// // sqlsrv_connect()
// ?>