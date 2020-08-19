<?php

include '../BD/config.php';
include '../BD/db.php';
include_once '../bd/conexion.php';


$nombre = filter_input(INPUT_POST, 'nombre');
$apellidos = filter_input(INPUT_POST, 'apellidos');
$correo = filter_input(INPUT_POST, 'correo');
$fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento');
$user = filter_input(INPUT_POST, 'user');
$password = filter_input(INPUT_POST, 'password');
$sexo = filter_input(INPUT_POST, 'sexo');
$password=hash('sha512',$password);



$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_externo FROM usuarios_externos where usuario='$user'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

$id = NULL;

?>
<?php                            
    foreach($data as $dat) {                                                        
?>    
     <?php $id = $dat['id_externo'] ?> 
<?php
    }
?> 

<?php     
if($id!=NULL){
    ?>
    <script src="../js/uexistente_ext.js"></script>
    <?php
}else{
    // Obtención del objeto PDO para la interaccion con DB.
$db = getPdo();  

// Comando SQL para insertar el registro.

$sqlCmd = 'INSERT INTO usuarios_externos(nombre, apellidos, sexo, fecha_nacimiento, correo, usuario, contraseña) 
VALUES (:nombre, :apellidos,:sexo, :fecha_nacimiento, :correo, :user, :password)';


// Obtención del objeto Statement para hacer la ejecución a la DB.
$stmt = $db->prepare($sqlCmd);

// Paso de parámetros al comando SQL de insert.
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellidos', $apellidos);
$stmt->bindParam(':sexo', $sexo);
$stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':user', $user);
$stmt->bindParam(':password', $password);




// Ejecución de la instruccion a DB.
$stmt->execute();

?>

<script src="../js/registro_externo.js"></script>

<?php
}
?>








    
