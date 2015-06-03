<?php
/*function conectar(){
      $usuarioBD ="root";
       $pass ="root";
       $host = "localhost";
       $bd = "proyecto";
       $conexion = new mysqli($host,$usuarioBD,$pass,$bd);
       //Hacemos una consulta a ver si el usuario existe
       if ($conexion->connect_errno){
           echo ("Se ha producido un error conectado a la base de datos ".$conexion->connect_error);
           return null;
       }
       return $conexion;
}*/
function conectar(){
      $usuarioBD ="albapardos_root";
       $pass ="rooter";
       $host = "localhost";
       $bd = "albapardos_proyecto";
       $conexion = new mysqli($host,$usuarioBD,$pass,$bd);
       //Hacemos una consulta a ver si el usuario existe
       if ($conexion->connect_errno){
           //echo ("Se ha producido un error conectado a la base de datos ".$conexion->connect_error);
           return null;
       }
       return $conexion;
}
?>