  <?php 
        include_once"mysql.php";

    session_start();
if(isset($_POST['nuevoNombre'])!=""){
        $conexion=  conectar();

        $nombre=$_SESSION['usuario'];
        $pass=$_SESSION['pass'];
        $nombre1=$_POST['nuevoNombre'];
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
        //echo "Mi \"$id\"  \"$n\" \"$p\" \"$acceso\"<br/>";
        
         if($consulta->fetch()){
                echo("hooooola");
                
                    //cerramos la consulta anterior
                    $consulta->close();
                    $conexion->close();
                    //echo '<br/>cierro conexion';
                    
                    //tenemos que buscar si el nuevo nombre existe o no (dos usuarios no se pueden llamar igual)
                    $conexion=  conectar();
                    $consulta = $conexion->stmt_init();
                    $sentencia= "select * from usuario where nick = ?";
                    //Preparamos la sentencia
                    $consulta->prepare($sentencia);

                    //Pasamos los parámetros con param
                    $consulta->bind_param("s",$nombre1);

                    //Ejecutamos la sentencia
                    $consulta->execute();
                        //Extraemos los valores
                    $consulta->bind_result($id,$n,$p,$acceso);
                    //echo "Mi \"$id\"  \"$n\" \"$p\" \"$acceso\"<br/>";
        
                    if($consulta->fetch()){
                        //si el nombre ya existe en la base de datos
                        echo 'Ese nombre ya está escogido, por favor, prueba con otro';
                    }
                    else{
                        //cerramos la consulta anterior
                        $consulta->close();
                        $conexion->close();
                        //actualizamos la columna acceso (lo podremos a 1 para saber que no es la primera vez que se ha metido el usuario)
                        $conexion2=  conectar();
                        $consulta_update = $conexion2->stmt_init();
                        $update= "UPDATE usuario SET nick=? WHERE nick= ?";
                        $consulta_update->prepare($update);                  
                        $acceso=true;
                        $consulta_update-> bind_param("ss",$nombre1,$nombre);
                        $consulta_update->execute();
                        //echo "update realizado";
                        //cerramos la consulta
                        $consulta_update->close();
                        //cerramos la conexión con la base de datos
                        $conexion2->close();
                        //echo 'cambio variable sesion';
                        $_SESSION['usuario'] = $nombre1;
                    echo 'Nombre cambiado con éxito';
                    header("Content-type=text/html;  charset=utf-8");
                    header("Location:http://www.albapardos.infenlaces.com/proyecto/personaje.html");  
           
        }//End executa consulta fetch
    }else{
        echo 'El nombre debe tener como mínimo un carácter';
        $consulta->close();
        $conexion->close();
    }
    ?>
      