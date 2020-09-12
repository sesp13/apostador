<?php

function decodificarString($string){
    // return $string;
    return utf8_decode($string);
}

function codificarString($string){
    return $string;
    // return utf8_encode($string);
}