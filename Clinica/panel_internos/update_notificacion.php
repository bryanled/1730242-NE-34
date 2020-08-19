<?php

include '../BD/config.php';
include '../BD/db.php';

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$id_paciente = $_POST['id_paciente'];
$nombre_interno = $_POST['nombre_interno'];
$id_notificacion = $_POST['id_notificacion'];
$estado = 1;


echo $id_notificacion;




include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "UPDATE notificacion SET titulo='$titulo', id_estado_n='$estado', detalle='$descripcion',fecha='$fecha', nombre_interno='$nombre_interno' WHERE id_notificacion='$id_notificacion' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   



// Ejecución de la instruccion a DB.



?>

<script language="javascript">
    
    id = "<?php echo $id_paciente?>";

    alert("¡Notificación Actualizada Con Éxito");    
    window.location.href = "panel_interno.php";  

</script>

