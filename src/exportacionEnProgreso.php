<?php
    // Tratamiento del id de tarea en pendiente, paso a en progreso
    
    $idpendiente=$_POST["idpendiente"];

    $servidor = "localhost"; 
    $user = "root"; 
    $password = null; 
    $database = "agendatareas"; 

    $db = new mysqli($servidor,$user, $password,$database); 
    if($db->connect_error){ 
        die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
    } 

    $sentencia = $db->prepare("UPDATE `tareas` SET `estado`=? WHERE `id`=?"); 
    $sentencia->bind_param('si', $param1,$param2); 

    $param1="enprogreso";
    $param2=$idpendiente;
    $sentencia->execute(); 
    echo "volver atras y actualizar";  

    $sentencia->close();
    $db->close();  