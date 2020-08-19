<?php 
include_once '../db.php';
include_once '../db-functions.php';

setRealBank($conn);

header('Location:../index.php');