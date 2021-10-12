<!DOCTYPE html>
<html lang="es">
   <head> 
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="La agenda personal más innovadora y efectiva">
      <title>MI AGENDA PERSONAL®</title>
      <link rel="stylesheet" href="css/styles.css">

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Handlee&family=Itim&display=swap" rel="stylesheet">
      <!-- <div class="a1"></div>
         <div class="a2"></div>
         <div class="a3"></div>
         <div class="a4"></div>
         <div class="a5"></div> -->
   </head>
   <body>

      <?php
         $servidor = "localhost"; 
         $user = "root"; 
         $password = null; 
         $database = "agendatareas"; 
         $db = new mysqli($servidor,$user, $password,$database); 
         if($db->connect_error){ 
            die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
         } 
      ?>

      <header class="headerindex"><h1> TAREAS </h1></header>
         
      <main class="mainindex">

         <section class="boxtareas tareaIngres">
            <h3>INGRESO</h3>
            <!-- Obtener datos necesarios para ingresar tarea -->
            <form method="post" action="ingresoTarea.php" enctype="application/x-www-form-urlencoded">
               <fieldset>
                  <legend> Nueva Tarea </legend>    
                  <div><label> Ingresa tarea: <input type="text" name="tarea" required></label></div> 
                  <label> Prioridad: común <input type=radio name="prioridad[]" value="comun" required></label>
                  <label>  urgente <input type=radio name="prioridad[]" value="urgente" required></label>
                  <label> absoluta <input type=radio name="prioridad[]" value="absoluta" required></label>
                  <div><button type="submit"> Agregar tarea </button></div>
               </fieldset>
            </form>
            <!-- Obtener la id de tarea a borrar -->
            <form method="post" action="borradoTarea.php" enctype="application/x-www-form-urlencoded" >
               <fieldset>
                  <legend> Borrar Tarea </legend>
                  <div><label> Ingresa id: <input type="number" name="id" required></label>
                  <button type="submit"> Borrar </button></div>   
               </fieldset>
            </form>
         </section>
      
         <section class="boxtareas tareasPend">
           
            <h3>PENDIENTES</h3>
            <!-- Formulario exportacion de id de pendiente a en progreso -->   
            <form method="post" action="exportacionEnProgreso.php" enctype="application/x-www-form-urlencoded"> 
               <fieldset>
                  <legend> Exportar a tareas en progreso </legend>
                  <div><label> Ingresa id: <input type="number" name="idpendiente" required></label>  
                  <button type="submit"> Exportar </button></div> 
               </fieldset>
            </form>

            <?php    // muestro tareas PENDIENTES activas (borrado=1)  por ORDEN PRIORIDAD.  
               $sentencia = $db->prepare("SELECT * FROM `tareas` WHERE `estado`=? AND `prioridad`=? AND `borrado`=?"); 
               $sentencia->bind_param('ssi', $param1, $param2,$param3); 
                  // 
               $param1="pendiente";
               $param2="absoluta";
               $param3=1;
               $sentencia->execute(); 
               $sentencia->bind_result($id, $tarea,$fhalta,$estado,$prioridad,$borrado); 
               
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; } 
               $param2="urgente";
               $sentencia->execute(); 
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; } 
               $param2="comun";
               $sentencia->execute();
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; }   
            ?>
            
         </section>

         <section class="boxtareas tareasProg">
            
            <h3>EN PROGRESO</h3>
            <!-- Formulario exportacion de id de en progreso a finalizadas -->
            <form method="post" action="exportacionFinalizadas.php" enctype="application/x-www-form-urlencoded"> 
               <fieldset>
                  <legend> Exportar a tareas finalizadas </legend>  
                  <div><label> Ingresa id: <input type="number" name="idenprogreso" required></label> 
                  <button type="submit"> Exportar </button></div>
               </fieldset>
            </form>    

            <?php    // muestro tareas en progreso activas (borrado=1) por orden prioridad. 
               $param1="enprogreso";
               $param2="absoluta";
               $param3=1;
               $sentencia->execute();
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; }  
               $param2="urgente";
               $sentencia->execute();
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; }    
               $param2="comun";
               $sentencia->execute();
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; }    
               $sentencia->close(); 
            ?>
            
         </section>

         <section class="boxtareas tareasFin">
            
            <h3>FINALIZADAS</h3>      
            <?php   // muestro tareas en finalizadas activas (borrado=1) orden alfabetico descendente
               $sentencia = $db->prepare("SELECT * FROM `tareas` WHERE `estado`=? AND `borrado`=? ORDER BY `tarea`"); 
               $sentencia->bind_param('si', $param1, $param2); 

               $param1="finalizada";
               $param2=1;
               $sentencia-> execute();
               $sentencia->bind_result($id, $tarea,$fhalta,$estado,$prioridad,$borrado);
               while ($sentencia->fetch()){ echo "<ol><li> $id </li><li> $tarea </li><li class=ocultar> $prioridad </li></ol>"; }   
               $sentencia->close(); 

               $db->close();   
            ?>
            
         </section>

      </main>
      <footer class="footerindex">
         <section>
            <h3>Contacto</h3>
            <ul class="iconos">
               <li><a href="#" > GitHub </a></li>
               <li><a href="#" > Instagram </a></li>
               <li>
                  <a href="https://www.linkedin.com/in/mois%C3%A9s-mu%C3%B1oz-aranda-5353b3221/"> LinkedIn </a>
               </li>
            </ul>
         </section>
      </footer>

   </body>
</html>