<?php
    $fichero1=fopen("pendientes.txt","rb");
    // cada lectura de linea la considerare un registro, y la contare como tal en $contadoregistros,
    // me dara numero total de registros en mi fichero.
    $contadoregistros=0;
    while($linea=fgets($fichero1)){
        list($preid,$id,$tarea)=explode(".","$linea");
        $contadoregistros++;
    }
    /* una ves tenemos el numero de registros existentes en fichero, deducimos para nuestro validador que 
    los id comenzaran en 0 pues, empezaremos a buscar por el, si no mostrara error
    Buscamos el registro consecutivo al cero, en nuestro fichero, y consecutivo al 1...
    si el total de registros existentes consecutivos coincide con todos los registos $contadoresgistros

    deducimos que ninguno se repite ni existen huecos, si los hay mostrara error*/
    fseek($fichero1,0);
    $totalregistrosconsecutivos=0;
    while($linea=fgets($fichero1)){
        list($preid,$id,$tarea)=explode(".","$linea");
        if($id==$totalregistrosconsecutivos){
            $totalregistrosconsecutivos++;
            fseek($fichero1,0);
        } 
    }
    fclose($fichero1);
    if($contadoregistros==$totalregistrosconsecutivos){
        echo "Todos las ids han sido revisadas, comienza por 0, no existen huecos, y no se repiten.";
    }
    else{
        echo "Error, quizá la id NO comienza por 0, EXISTEN huecos entre ids, o se REPITEN.</br>
        Porfavor corrija el error de forma manual, para poder mostrar sus tareas.";
    }

