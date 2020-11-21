<!DOCTYPE html>
<html lang="es">
   <head> 
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="La agenda personal más innovadora y efectiva">
      <title>MI AGENDA PERSONAL®</title>
   </head>
   <!--problema, solucion, justificación-->
   <body>
      <center><header><h1>TAREAS</h1></header></center>

      <!-- En la etapa 2 de la fase 2  vamos a crear tareas tareas pendientes desde aplicacion web 
      creo un formulario con los campos que requerimos, enviamos a recogida.php mediante metodo post, 
      escribiremos los id y las tareas si cumplen los requesitos que marcamos -->

      <form method="post" action="recogida.php" enctype="application/x-www-form-urlencoded">
         <fieldset>
            <legend> Nueva Tarea </legend>
            <div><label>ingresa id: <input type=number name="id" ></label></div>
            <div><label>ingresa tarea: <input type=text name="tarea" required></label></div>
         </fieldset>
            <div><button type=submit>Agregar tarea</div>
      </form>

      <?php
         echo "<h3>PENDIENTES</h3>";
         $pendientes= fopen("pendientes.txt","rb");
            /* abro fichero solo lectura, y meto en variable.
               Genero variable contador, nos servirá como comparativa de igualdad en nuestra busqueda.
               estructura de repetición while, mientras leamos linea del fichero
               listamos, obtenemos variable id, y variable tarea, comparamos con contador aver si es la que queremos.
               si es: imprimimos, sumamos 1 a contador para buscar la siguiente, y reiniciamos fichero.
               si no es: seguimos con la siguiente cadena del fichero obtenemos id tarea, comparamos.....
            */
         $contador=0;
         while($cadena= fgets($pendientes)){
            list($preid,$id,$tarea)=explode(".","$cadena");
            /* Condición para encontrar el id que busco en fichero.
               Sumo 1 a contador, para buscar siguiente.
               Con fseek establezco el indicador de posición a inicio
            */
            if($id==$contador){
               if($preid==1){
                  echo "id: $id   tarea: $tarea</br>";
                  $contador++;
                  fseek($pendientes,0);        
               }
               /*condiciono mi contador, para que cuente y no muestre, los preid=0 */
               elseif($preid==0){
                  $contador++; 
                  fseek($pendientes,0);
               } 
            } 
         }
         fclose ($pendientes);
      ?>
      <!--Realizo un formulario para obtener las ids, a borrar de pendientes.txt-->
      <form method="post" action="borrar1.php" enctype="application/x-www-form-urlencoded" >
         <fieldset>
            <legend>borrar tareas pendientes</legend>
            <div><label>ingresa id<input type=text name="id" required></label></div>
            <div><button type=submit>borrar</button></div>   
         </fieldset>
      </form>

      <?php     
         echo "<h3>EN PROGRESO</h3>";
         $progreso= fopen("enprogreso.txt","rb");
         $contador=0;
         while($cadena= fgets($progreso)){
            list($preid,$id,$tarea)=explode(".","$cadena");
            if($id==$contador){
               if($preid==1){
                  echo "id: $id   tarea: $tarea</br>";
                  $contador++;
                  fseek($progreso,0);        
               }
               elseif($preid==0){
                  $contador++; 
                  fseek($progreso,0);
               } 
            } 
         }
         fclose ($progreso);
      ?>
      <!--Realizo un formulario para obtener las ids, a borrar de enprogeso.txt-->
      <form method="post" action="borrar2.php" enctype="application/x-www-form-urlencoded" >
         <fieldset>
            <legend>borrar tareas en progreso</legend>
            <div><label>ingresa id<input type=text name="id2" required></label></div>
            <div><button type=submit>borrar</button></div>   
         </fieldset>
      </form>

      <?php 
         echo "<h3>FINALIZADAS</h3>";
         $finalizadas= fopen("finalizadas.txt","rb");
         $contador=0;
         while($cadena= fgets($finalizadas)){
            list($preid,$id,$tarea)=explode(".","$cadena");
            if($preid==0){
               $contador++;
            }
            if($id==$contador&&$preid==1){
            echo "id: $id   tarea: $tarea</br>";
               $contador++;
               fseek($finalizadas,0);
            }
         }
         fclose ($finalizadas);
      ?>

   </body>
</html>


