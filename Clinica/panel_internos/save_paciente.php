<?php

include '../BD/config.php';
include '../BD/db.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$sexo = $_POST['sexo'];
$fecha_n = $_POST['fecha_n'];

$fecha_i = $_POST['fecha_i'];
$motivo = $_POST['motivo'];
$diagnostico = $_POST['diagnostico'];

$id_estado_p=1;

$db = getPdo();  

$sqlCmd = 'INSERT INTO pacientes(nombre, apellidos, sexo, fecha_nacimiento, id_estado_p) 
VALUES (:nombre, :apellidos, :sexo,:fecha_n, :id_estado_p)';

$stmt = $db->prepare($sqlCmd);

// Paso de parámetros al comando SQL de insert.
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellidos', $apellidos);
$stmt->bindParam(':sexo', $sexo);
$stmt->bindParam(':fecha_n', $fecha_n);
$stmt->bindParam(':id_estado_p', $id_estado_p);

// Ejecución de la instruccion a DB.
$stmt->execute();


// Consulta del ID recien insertado para agregarlo al expediente

include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT MAX(id_paciente) AS id FROM pacientes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                           
foreach($data as $dat) {                                                        
     $id_paciente = $dat['id'];
}

    

// Insercion de datos al expediente 
$sqlCmd = 'INSERT INTO expedientes(id_paciente, fecha_hora_ingreso, motivo_ingreso, diagnostico) 
VALUES (:id_paciente, :fecha_hora_ingreso, :motivo_ingreso,:diagnostico)';

$stmt = $db->prepare($sqlCmd);

// Paso de parámetros al comando SQL de insert.
$stmt->bindParam(':id_paciente', $id_paciente);
$stmt->bindParam(':fecha_hora_ingreso', $fecha_i);
$stmt->bindParam(':motivo_ingreso', $motivo);
$stmt->bindParam(':diagnostico', $diagnostico);

// Ejecución de la instruccion a DB.
$stmt->execute();


?>

<script language="javascript">
    
    

    alert("Paciente Registrado Con Éxito!");    
    window.location.href = "panel_interno.php";  

</script>

