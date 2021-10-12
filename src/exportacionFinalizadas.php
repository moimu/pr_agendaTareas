<?php
    // Tratamiento del id de tarea en progreso, paso a finalizadas

    $idenprogreso=$_POST["idenprogreso"];

    $servidor = "localhost"; 
    $user = "root"; 
    $password = null; 
    $database = "agenda"; 

    $db = new mysqli($servidor,$user, $password,$database); 
    if($db->connect_error){ 
        die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
    } 

    $sentencia = $db->prepare("UPDATE `tareas` SET `estado`=? WHERE `id`=?"); 
    $sentencia->bind_param('si', $param1,$param2); 

    $param1="finalizada";
    $param2=$idenprogreso;
    $sentencia->execute(); 
    echo "volver atras y actualizar";  

    $sentencia->close();
    $db->close();  