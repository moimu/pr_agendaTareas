CREATE DATABASE `agenda`

CREATE TABLE `tareas`(
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `tarea` VARCHAR(255) NOT NULL,
    `fhalta` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `estado` CHAR(10) NOT NULL DEFAULT 'pendiente',
    `prioridad` CHAR(10) NOT NULL DEFAULT 'comun',
    `borrado` CHAR(1) NOT NULL DEFAULT 1
);

INSERT INTO `tareas` (`tarea`,`prioridad`) VALUES ('desmontar el belen','absoluta'),('dejar de comer polvorones','comun'),('estudiar inglés','comun'),('ejercicio fisico','comun'),('pensar antes de hablar','absoluta'),('controlar emociones','comun'),('comer fit','comun'),('dejar el café','urgente'),('saludo al sol cada mañana','urgente'),('leer libro antes de dormir','urgente');
INSERT INTO `tareas` (`tarea`, `estado`,`prioridad`) VALUES ('limpiar coche domingos','enprogreso','comun'),('agenda de tareas','enprogreso','absoluta'),('fondo de armario','enprogreso','comun'),('aprender percusión basica','enprogreso','comun'),('no ver tanto youtube','enprogreso','absoluta'),('leer documentaciones','enprogreso','absoluta'),('estrategias de orden','enprogreso','comun'),('beber suficiente agua','enprogreso','urgente'),('backout datos','enprogreso','urgente'),('leer psicologia social','enprogreso','urgente');
INSERT INTO `tareas` (`tarea`, `estado`) VALUES ('leer inteligencia emocional','finalizada'),('comprar deportivas','finalizada'),('vender ropa que no uso','finalizada'),('ir a la paya','finalizada'),('tomar sol','finalizada'),('aprender recetas lentejas','finalizada'),('perfecionar palomitas caramelo','finalizada'),('comer mas fruta','finalizada'),('reducir netflix','finalizada'),('ir a la luna','finalizada');