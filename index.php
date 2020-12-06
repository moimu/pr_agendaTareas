<!DOCTYPE html>
<html lang="es">
   <head> 
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="La agenda personal más innovadora y efectiva">
      <title>MI AGENDA PERSONAL®</title>
      <link rel="stylesheet" href="estilostareas.css">
   <body>
      <header><h1>AGENDA  DE  TAREAS</h1></header>
      <section class="tareaIngres">
         <!-- En la etapa 2 de la fase 2  vamos a crear tareas tareas pendientes desde aplicacion web 
         creo un formulario con los campos que requerimos, enviamos a recogida.php mediante metodo post, 
         escribiremos los id y las tareas si cumplen los requesitos que marcamos -->
         
         <form method="post" action="recogida.php" enctype="application/x-www-form-urlencoded">
            <fieldset>
               <legend> Nueva Tarea </legend>
               <div><label> Ingresa id: <input type="number" name="id" ></label></div>
               <div><label> Ingresa tarea: <input type="text" name="tarea" required></label>
               <button type="submit"> Agregar tarea </button></div>
            </fieldset>
         </form>
      </section>
      <section class="tareasPend">
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
               <legend> Borrar tareas pendientes </legend>
               <div><label> Ingresa id: <input type="number" name="id" required></label>
               <button type="submit"> Borrar </button></div>   
            </fieldset>
         </form>
         <!-- Formulario exportacion de id de pendientes.txt a enprogreso.txt -->   
         <form method="post" action="exportarenprogreso.php" enctype="application/x-www-form-urlencoded"> 
            <fieldset>
               <legend> Exportar a tareas en progreso </legend>
               <div><label> Ingresa id: <input type="number" name="id" required></label>  
               <button type="submit"> Exportar </button></div> 
            </fieldset>
         </form>
      </section>
      <section class="tareasProg">
         <?php   
            // muestro tareas activas, por orden de escritura en el fichero  
            echo "<h3>EN PROGRESO</h3>";
            $progreso= fopen("enprogreso.txt","rb");
            while($cadena= fgets($progreso)){
               list($preid,$id,$tarea)=explode(".","$cadena");
               if($preid==1){
                  echo "id: $id   tarea: $tarea</br>";     
               }
            }
            fclose ($progreso);
         ?>
         <!--Realizo un formulario para obtener las ids, a borrar de enprogeso.txt-->
         <form method="post" action="borrar2.php" enctype="application/x-www-form-urlencoded" >
            <fieldset>
               <legend > Borrar tareas en progreso </legend>
               <div><label> Ingresa id: <input type="number" name="id2" required></label>
               <button type="submit"> Borrar </button></div>   
            </fieldset>
         </form>
         <!-- Formulario exportacion de id de enprogreso.txt a finalizadas.txt -->
         <form method="post" action="exportarfinalizadas.php" enctype="application/x-www-form-urlencoded"> 
            <fieldset>
               <legend> Exportar a tareas finalizadas </legend>  
               <div><label> Ingresa id: <input type="number" name="id" required></label> 
               <button type="submit"> Exportar </button></div>
            </fieldset>
         </form>
      </section>
      <section class="tareasFin">
         <?php    
            // muestro tareas activas, por orden de escritura en el fichero
            echo "<h3>FINALIZADAS</h3>";
            $finalizadas= fopen("finalizadas.txt","rb");
            while($cadena= fgets($finalizadas)){
               list($preid,$id,$tarea)=explode(".","$cadena");
               if($preid==1){
                  echo "id: $id   tarea: $tarea</br>";  
               } 
            }
            fclose ($finalizadas);
         ?>
      </section>
   </body>
</html>


