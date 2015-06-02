 <?php 
        include_once"mysql.php";
                //Tengo que mirar la base de datos
        $conexion=  conectar();
                //Miramos a ver si no existe
        $nombre=$_POST['user'];
        $pass=$_POST['pass'];
        //Iniciamos la consulta preparada
        $consulta = $conexion->stmt_init();
        
        $sentencia= "select * from usuario where nick = ? and password = ? ";
        
        //Preparamos la sentencia
        $consulta->prepare($sentencia);
        
        //Pasamos los parámetros con param
        $consulta->bind_param("ss",$nombre,$pass);
        
        //Ejecutamos la sentencia
        $consulta->execute();
            //Extraemos los valores
        $consulta->bind_result($id,$n,$p,$acceso);
        echo "Mi \"$id\"  \"$n\" \"$p\" \"$acceso\"<br/>";
        
           if($consulta->fetch()){
                echo("hooooola");
                //Si es la primera vez que accedo
                if ($acceso==false){
                     //cerramos la consulta anterior
                    $consulta->close();
                    //actualizamos la columna acceso (lo podremos a 1 para saber que no es la primera vez que se ha metido el usuario)
                    $consulta_update = $conexion->stmt_init();
                    $update= "UPDATE usuario SET acceso=?";
                    $consulta_update->prepare($update);
                    $consulta_update -> bind_param("i",1);
                    $consulta_update->execute();
                    echo "update realizado";
                    //cerramos la consulta
                    $consulta_update->close();
                    //cerramos la conexión con la base de datos
                    $conexion->close();
                    header("Content-type=text/html;  charset=utf-8");
                    header("Location:http://localhost/prueba_proyecto/creaPersonaje.html?usuario=$nombre");
                }else{
                    //Si no es la primera vez accedo al porta
                    $consulta->close();
                    $conexion->close();
                    //header("Content-type: text/html; charset=utf-8") ;
//                    header("Location:http://localhost/prueba_proyecto/personaje.html?usuario=$nombre");
                    header("Location:http://www.albapardos.infenlaces.com/proyecto/personaje.html?usuario=$nombre");
                }
           
        }//End executa consulta fetch
        else {//Caso de que este usuario o pass son incorrectos
             $conexion->close();
             $consulta->close();
             echo "<h2>No existe el usuario $nombre en la base de datos o password incorrecta";    
             header ("Content-type: text/html; charset=utf-8");
             header ("refresh:5; Location:http://www.albapardos.infenlaces.com/proyecto/index.html?usuario=$nombre");
             exit();
        }
    ?>