<?php 
include_once"mysql.php";
    session_start();
if(isset ($_POST['respuesta'])!=""){
 
        //Iniciamos la consulta preparada
        $respuestaElegida=$_POST['respuesta'];
        $correcta=$_SESSION['respuestaCorrecta'];

        if($respuestaElegida==$correcta){
                echo "acertada";
        $consulta->close();
        $conexion->close();
        


//actualizamos la columna estado (lo podremos a 1 para saber que está contestada y acertada)
                    $conexion2=  conectar();
                    $consulta_update = $conexion2->stmt_init();
                    $update= "UPDATE reto SET estado=? WHERE usuarioRecibe= ?";
                    $consulta_update->prepare($update);                  
                    $estado=true;
                    $usuarioRecibe=$_SESSION['usuario'];
                    $consulta_update-> bind_param("is",$estado,$usuarioRecibe);
                    $consulta_update->execute();
                    //echo "update realizado";
                    //cerramos la consulta
                    $consulta_update->close();
                    //cerramos la conexión con la base de datos
                    $consulta_update->close();
                    $conexion2->close();

        header("Content-type=text/html;  charset=utf-8");
        header("Location:http://www.albapardos.infenlaces.com/proyecto/tienda.html");  
        }
        else{
            echo "fallada";
            $consulta->close();
            $conexion->close();
                    header("Content-type=text/html;  charset=utf-8");
        header("Location:http://www.albapardos.infenlaces.com/proyecto/inicial.html");  
        }


    }
    ?>
 