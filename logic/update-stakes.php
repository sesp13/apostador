<?php 
include_once '../database/conn.php';
include_once '../database/db-functions.php';

setRealBank($conn);

header('Location:../index.php');