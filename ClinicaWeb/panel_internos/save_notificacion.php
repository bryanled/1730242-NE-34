<?php

include '../BD/config.php';
include '../BD/db.php';

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$id_paciente = $_POST['id_paciente'];
$nombre_interno = $_POST['nombre_interno'];


$estado = 1;


$db = getPdo();  
$sqlCmd = 'INSERT INTO notificacion(titulo, detalle, nombre_interno, fecha, id_estado_n, id_paciente) 
VALUES (:titulo, :detalle, :nombre_interno, :fecha, :id_estado_n, :id_paciente)';

$stmt = $db->prepare($sqlCmd);

// Paso de parámetros al comando SQL de insert.
$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':detalle', $descripcion);
$stmt->bindParam(':nombre_interno', $nombre_interno);
$stmt->bindParam(':fecha', $fecha);
$stmt->bindParam(':id_estado_n', $estado);
$stmt->bindParam(':id_paciente', $id_paciente);


// Ejecución de la instruccion a DB.
$stmt->execute();


?>

<script language="javascript">
    
    id = "<?php echo $id_paciente?>";

    alert("¡Notificación Emitida Con Éxito");    
    window.location.href = "panel_pacientes.php? id="+id;  

</script>

