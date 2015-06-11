<?php 
        include_once"mysql.php";
    session_start();
if(isset ($_POST['aUser'])!="" && ($_POST['pregunta'])!="" && ($_POST['puntosApostados'])!=""){
        $conexion=conectar();
        $nombre=$_SESSION['usuario'];
        $aUser=$_POST['aUser'];
        $pregunta=$_POST['pregunta'];
        $apuesta=$_POST['puntosApostados'];
        //Iniciamos la consulta preparada
        $_SESSION['idPregunta']=$pregunta;
        $consulta = $conexion->stmt_init();
        //seleccionamos la pregunta y la respuesta correcta
        $sentencia="INSERT INTO reto values (?,?,?,?,?) ";
  
                //Preparamos la sentencia
        $consulta->prepare($sentencia);
        
        $estado=false;
        //Pasamos los parámetros con param
        $consulta->bind_param("ssiii",$nombre,$aUser,$pregunta,$apuesta,$estado);

        //Ejecutamos la sentencia
        $consulta->execute();
        
        
        $consulta->close();
        $conexion->close();


        echo("La pregunta se ha formulado correctamente");
        header("Content-type=text/html;  charset=utf-8");
        header("Location:http://www.albapardos.infenlaces.com/proyecto/inicial.html");  
    }
    ?>