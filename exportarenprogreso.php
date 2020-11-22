<?php
    $idexportar=$_POST["id"];
    $fichero=fopen("pendientes.txt","c+b");
    $id=-1;
    while($idexportar!=$id){
        $linea=fgets($fichero);
        list($preid,$id,$tarea)=explode(".","$linea");
        if($idexportar==$id){
            //escribimos la tarea
            $fichero1=fopen("enprogreso.txt","ab");
            fwrite($fichero1,"$linea");
            fclose($fichero1);
            // borramos la tarea
            $num=strlen($linea)*-1;
            fseek($fichero,$num,SEEK_CUR);
            fwrite($fichero,"0");
        }
    }
    fclose($fichero);
    echo "id: $idexportar exportada a tareas en progreso, vuelva atrás y actualice";