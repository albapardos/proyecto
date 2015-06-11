  <?php 

    session_start();
$bd_host = "localhost"; 
$bd_usuario = "albapardos_root"; 
$bd_password = "rooter"; 
$bd_base = "albapardos_proyecto"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 

mysql_select_db($bd_base, $con); 

//consulta todas las preguntas

$sql=mysql_query("SELECT * FROM preguntas WHERE curso= '".$_SESSION['curso']."' ",$con);

//muestra los datos consultados
echo "Asignatura - ID - Pregunta \n";
while($row = mysql_fetch_array($sql)){
	echo "<p>".$row['idAsignatura']." - ".$row['idPregunta']." - ".$row['pregunta']."</p> \n";
}

    
    ?>
      