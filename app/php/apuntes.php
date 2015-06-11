  <?php 

    session_start();
$bd_host = "localhost"; 
$bd_usuario = "albapardos_root"; 
$bd_password = "rooter"; 
$bd_base = "albapardos_proyecto"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 

mysql_select_db($bd_base, $con); 

//consulta todos los apuntes

$sql=mysql_query("SELECT nick FROM usuario WHERE curso=".$_SESSION['curso'],$con);

//muestra los datos consultados
while($row = mysql_fetch_array($sql)){
    echo "<p>".$row['nick']."\n";
}

    
    ?>
      