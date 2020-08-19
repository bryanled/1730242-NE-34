<?php


include '../BD/config.php';
include '../BD/db.php';


$id_paciente = $_POST['id_paciente'];
$id_externo = $_POST['id_externo'];
$parentesco = $_POST['parentesco'];


$db = getPdo();  
$sqlCmd = 'INSERT INTO asignaciones(id_paciente, id_externo, parentesco) 
VALUES (:id_paciente, :id_externo, :parentesco)';

$stmt = $db->prepare($sqlCmd);

// Paso de parámetros al comando SQL de insert.
$stmt->bindParam(':id_paciente', $id_paciente);
$stmt->bindParam(':id_externo', $id_externo);
$stmt->bindParam(':parentesco', $parentesco);



// Ejecución de la instruccion a DB.
$stmt->execute();

?>


<script language="javascript">
        
    alert("¡Asignación Ejecutada Con Éxito!");    
    window.location.href = "panel_interno.php";  

</script>


