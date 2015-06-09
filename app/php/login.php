 <?php 
        include_once"mysql.php";
        
    session_start();
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
        //echo "Mi \"$id\"  \"$n\" \"$p\" \"$acceso\"<br/>";
        
           if($consulta->fetch()){
                //guardamos como variables de sesión el usuario y el password que nos podrán servir más adelante
                $_SESSION['usuario'] = $nombre;
                $_SESSION['pass'] = $pass;
                //echo("hooooola");
                //Si es la primera vez que accedo
                if ($acceso==false){
                    //echo '<br/>primera vez';
                    //cerramos la consulta anterior
                    $consulta->close();
                    $conexion->close();
                    //echo '<br/>cierro conexion';
                    
//actualizamos la columna acceso (lo podremos a 1 para saber que no es la primera vez que se ha metido el usuario)
                    $conexion2=  conectar();
                    $consulta_update = $conexion2->stmt_init();
                    $update= "UPDATE usuario SET acceso=? WHERE nick= ?";
                    $consulta_update->prepare($update);                  
                    $acceso=true;
                    $consulta_update-> bind_param("is",$acceso,$nombre);
                    $consulta_update->execute();
                    //echo "update realizado";
                    //cerramos la consulta
                    $consulta_update->close();
                    //cerramos la conexión con la base de datos
                    $conexion2->close();

                    echo "Bienvenido $_SESSION['usuario']";
                    header("Content-type=text/html;  charset=utf-8");
                    header("Location:http://www.albapardos.infenlaces.com/proyecto/creaPersonaje.html");
                }else{
                   // echo 'no es la primera vez';
                    echo "Bienvenido $_SESSION['usuario']";
                    $consulta->close();
                    $conexion->close();
                    header("Content-type: text/html; charset=utf-8") ;
                    header("Location:http://www.albapardos.infenlaces.com/proyecto/personaje.html");
                }
           
        }//End executa consulta fetch
        else {//Caso de que este usuario o pass son incorrectos
            echo 'Usuario o password incorrectos';
             $conexion->close();
             $consulta->close();
             //echo "<h2>No existe el usuario $nombre en la base de datos o password incorrecta";    
             header ("Content-type: text/html; charset=utf-8");
             header ("refresh:5;Location:http://www.albapardos.infenlaces.com/proyecto/index.html");
             exit();
        }
    ?>
      