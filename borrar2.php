<?php   
  
    //para tareas en progreso
    $idborrar2=$_POST["id2"];
    $fichero=fopen("enprogreso.txt","c+b");
    $id=-1;
    while($id!=$idborrar2){
        $linea=fgets($fichero);
        list($preid,$id,$tarea)=explode(".",$linea);
        if($id==$idborrar2){
            $num=strlen($linea)*-1;
            fseek($fichero,$num,SEEK_CUR);
            fwrite($fichero,"0");
        }
    }
    fclose($fichero);
    echo "id: $idborrar2 borrada, vuelva atrás y actualice";