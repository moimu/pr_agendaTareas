<?php
    $tareaingres= $_POST["tarea"];
    $idingres= intval($_POST["id"]);

    /* En la etapa 2 de la fase 2 de nuestro proyecto vamos a crear tareas tareas pendientes desde la aplicacion web 
    para ello emos creado un formulario con los campos que requerimos enviamos a este script mediante el metodo post, 
    escribiremos los id y las tareas si cumplen los requesitos que marcamos a continuación*/

    
    /* listamos todas las lineas del fichero, para obtener la ultima id como referencia,
     para el ingreso de la siguiente, al leerlo comprobamos que la id ingresada no exista. */

    $fichero=fopen("pendientes.txt","rb");
    while($linea=fgets($fichero)){
        list($preid,$id,$tarea)=explode(".","$linea");
        $id= intval($id);
        if($idingres!=null && $idingres==$id){
            echo "!ERROR el id ingresado ya existe!</br>
            Vuelva atrás y especifique un id correcto (consecutivo), o deje el campo vacio.</br>";
        }
    }
    fclose($fichero);
     
    /* Atencion!! Consideramos que el archivo pendientes.txt, tendrá escrita almenos una tarea con id 0. 
    (sino deberá ser creada para el correcto funcionamieto de nuestro programa.) */
    // si el id es consecutivo se crea la tarea y el id sin problema.
    // escribo tambien el "preid" indicara, si la tarea esta activa o desactiva(borrada)
    $preid=1;
    $fichero= fopen("pendientes.txt","ab");
    if($idingres==$id+1){
        fwrite($fichero,"$preid.$idingres.$tareaingres\n");
        echo "Su tarea a sido añadida.<br>Vuelva atrás y actualice para ver la agenda";
    }

    // si el id no es ingresado se crea la tarea con un id consecutivo al ultimo existente.
    elseif($idingres==null){
        $idcreado=$id+1;
        fwrite($fichero,"$preid.$idcreado.$tareaingres\n");
        echo "Su tarea a sido añadida, el id se generó de forma consecutiva.<br>Vuelva atrás y actualice para ver la agenda";
    }

    //El id no es consecutivo: es mayor y no dejara meterlo; tampoco si es numero negativo.
    elseif($idingres>$id+1||$idingres<0){
        echo "!ERROR acción no contemplada!</br>
        Vuelva atrás y especifique un id correcto (consecutivo), o deje el campo vacio.";
    }
    fclose($fichero);