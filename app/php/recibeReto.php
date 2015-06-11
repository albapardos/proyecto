  <?php 

    session_start();
$bd_host = "localhost"; 
$bd_usuario = "albapardos_root"; 
$bd_password = "rooter"; 
$bd_base = "albapardos_proyecto"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 

mysql_select_db($bd_base, $con); 


$sql=mysql_query("SELECT * FROM reto WHERE usuarioRecibe= '".$_SESSION['usuario']."' AND estado=0",$con);

//muestra los datos consultados
echo "Retador - Apuesta \n";
while($row = mysql_fetch_array($sql)){
    echo "<p>".$row['usuarioManda']." - ".$row['apuesta']."</p> \n";
    $_SESSION['idPregunta']=$row['idPregunta'];

}

?>

  <?php 

    session_start();
$bd_host = "localhost"; 
$bd_usuario = "albapardos_root"; 
$bd_password = "rooter"; 
$bd_base = "albapardos_proyecto"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 

mysql_select_db($bd_base, $con); 

$sql=mysql_query("SELECT * FROM preguntas WHERE idPregunta='".$_SESSION['idPregunta']."' ",$con);

//muestra los datos consultados
echo "Pregunta \n";
while($row= mysql_fetch_array($sql)){
    echo "<p>".$row['pregunta']." </p> \n";
    $_SESSION['respuestaCorrecta']=$row['correcta'];
}
?>

  <?php 

    session_start();
$bd_host = "localhost"; 
$bd_usuario = "albapardos_root"; 
$bd_password = "rooter"; 
$bd_base = "albapardos_proyecto"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 

mysql_select_db($bd_base, $con); 

$sql=mysql_query("SELECT * FROM respuestas WHERE idPregunta='".$_SESSION['idPregunta']."' ",$con);

//muestra los datos consultados
echo "ID - Respuesta \n";
while($row= mysql_fetch_array($sql)){
    echo "<p>".$row['idRespuesta']." - ".$row['respuesta']." <br/>";
}
?>