<?php


include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$defunsion_date = $_POST['defunsion_date'];
$fecha_alta = $_POST['fecha_alta'];
$motivo_alta = $_POST['motivo_alta'];

$id_paciente = $_POST['id_paciente'];
$estado_paciente = $_POST['estado_paciente'];



$consulta = "UPDATE expedientes SET fecha_hora_alta='$fecha_alta', motivo_alta='$motivo_alta', fecha_defunsion='$defunsion_date' 
WHERE id_paciente='$id_paciente' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

$consultaII = "UPDATE pacientes SET id_estado_p='$estado_paciente' WHERE id_paciente='$id_paciente' ";		
        $resultadoII = $conexion->prepare($consultaII);
        $resultadoII->execute(); 
?>


<script language="javascript">
        
    alert("¡Paciente Dado De Alta Con Éxito!");    
    window.location.href = "panel_interno.php";  

</script>


