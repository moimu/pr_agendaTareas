<?php  

    $id=$_POST["id"];

    $servidor = "localhost"; 
    $user = "root"; 
    $password = null; 
    $database = "agendatareas"; 

    $db = new mysqli($servidor,$user, $password,$database); 
    if($db->connect_error){ 
        die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
    }      

    $sentencia = $db->prepare(" UPDATE `tareas` SET `borrado`=0 WHERE `id`=?"); 
    $sentencia->bind_param('i', $param1); 

    $param1=$id;
    
    $sentencia->execute(); 
    echo "volver atras y actualizar";

    $sentencia->close();
    $db->close();