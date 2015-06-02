 <?php 
        //Ya queremos cambiar la password
        if (isset($_POST['cambioPass'])){
            require_once 'mysql.php';
            //$cambio: booleando de la actualización en la bd.
            $cambio=false;            
            
            //Lemos la pasword nueva y la cambiamos en la base de datos
            $nombre = $_POST['nombre'];
            $pass1=$_POST['passNueva'];
            $pass2=$_POST['passNuevaConfirmacion'];
            //Previo condición de que las pass coincidan
            if ($pass1===$pass2){
                $conexion=conectar();
                $consulta=$conexion->stmt_init();
                $actualizacion="update usuarios set pass = ?, acceso= ? where nombre= ? ";
                $consulta->prepare($actualizacion);
                $acceso=true;
                $consulta->bind_param("sis",$pass1,$acceso,$nombre);
                //Ejecuto y verifico que la consulta ha tenido éxito
                if ($consulta->execute())
                    $cambio=true;

            }//End verificar pass iguales
            else{
                echo "<h2> No coinciden las password, vuelvelas a insertar </h2>";
            }
            
//Si se ha realizado el cambio accedemos al sistema "accedido.php", pasando el nombre de usuairo
            if($cambio){
                echo "<h2>Cambio realizado satisfactoriamente. <br/>En 5 segundos accederás al sistema</h2>";
                header("refresh:5;url=accedido.php?usuario=$nombre");
                exit();
            }
        }else
                 $nombre = $_GET['usuario'];
        
//End php 
     ?>