  <?php 
        include_once"mysql.php";
                //Tengo que mirar la base de datos
        $conexion=  conectar();
                //Miramos a ver si no existe
        $nombre=$_POST['usuario'];
        $pass=$_POST['passActual'];
        $pass1=$_POST['passNueva'];
        $pass2=$_POST['passNuevaConfirmacion'];
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
                if($pass1==$pass2){
                    //cerramos la consulta anterior
                    $consulta->close();
                    $conexion->close();
                    echo '<br/>cierro conexion';
                    
//actualizamos la columna acceso (lo podremos a 1 para saber que no es la primera vez que se ha metido el usuario)
                    $conexion2=  conectar();
                    $consulta_update = $conexion2->stmt_init();
                    $update= "UPDATE usuario SET password=? WHERE nick= ?";
                    $consulta_update->prepare($update);                  
                    $acceso=true;
                    $consulta_update-> bind_param("ss",$pass1,$nombre);
                    $consulta_update->execute();
                    echo "update realizado";
                    //cerramos la consulta
                    $consulta_update->close();
                    //cerramos la conexión con la base de datos
                    $conexion2->close();
                 
                    header("Content-type=text/html;  charset=utf-8");
                    header("Location:http://www.albapardos.infenlaces.com/proyecto/creaPersonaje.html");
                }else{
                    //Si no es la primera vez accedo al porta
                   // echo 'no es la primera vez';
                    $consulta->close();
                    $conexion->close();
                    header("Content-type: text/html; charset=utf-8") ;
                    header("Location:http://www.albapardos.infenlaces.com/proyecto/personaje.html");
                }
           
        }//End executa consulta fetch
        else {//Caso de que este usuario o pass son incorrectos
             $conexion->close();
             $consulta->close();
             echo "<h2>No existe el usuario $nombre en la base de datos o password incorrecta";    
             header ("Content-type: text/html; charset=utf-8");
             header ("refresh:5; Location:Location:http://www.albapardos.infenlaces.com/proyecto/index.html");
             exit();
        }
    ?>
      