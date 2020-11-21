<?php   

    $idborrar=$_POST["id"];
    /* ok recibiendo el id a borrar, vamos a marcarlo, para no mostrar, 
    creare un "pre id", que marcará si la tarea esta activa,( mostrar) 
    o desactivada (borrada), para no mostrarla en la lectura 
    1 activa  0 desactiva*/
    // c+ fopen para lectura y escritura, 
    $fichero=fopen("pendientes.txt","c+b");
    /* si leemos el id, ha borrar, retrocecedemos al principo de linea y marcamos con 0 */
    $id=-1;
    while($id!=$idborrar){
        $linea=fgets($fichero);
        list($preid,$id,$tarea)=explode(".",$linea);
        if($id==$idborrar){
            $num=strlen($linea)*-1;
            fseek($fichero,$num,SEEK_CUR);
            fwrite($fichero,"0");
        }
    }
    fclose($fichero);
    echo "id: $idborrar borrada, vuelva atrás y actualice";