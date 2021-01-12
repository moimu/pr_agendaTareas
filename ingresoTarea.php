<?php

    // recepción de tarea y prioridad, insercion en DB,  
    // Campos id y fhalta son generados automaticamente. Campos: estado, borrado son generados por defecto.

    $tarea=$_POST["tarea"];
    $prioridad=$_POST["prioridad"][0];

    $servidor = "localhost"; 
    $user = "root"; 
    $password = null; 
    $database = "agenda"; 
    
    $db = new mysqli($servidor,$user, $password,$database); 
    if($db->connect_error){ 
        die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
    }      

    $sentencia = $db->prepare("INSERT INTO `tareas`(`tarea`,`prioridad`) VALUES (?,?)"); 
    $sentencia->bind_param('ss', $param1, $param2); 
    
    $param1=$tarea;
    $param2=$prioridad;
    $sentencia->execute(); 
    echo "volver atras y actualizar";

    $sentencia->close();
    $db->close();   