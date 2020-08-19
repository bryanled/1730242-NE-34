<?php require_once "parte_superior.php"?>

<?php 

$nombre=$_SESSION['nombre'];
$apellidos=$_SESSION['apellidos'];

?>


<!--INICIO del cont principal-->
    
    
 <?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$id = $_GET["id"];

$consulta = "SELECT id_paciente, nombre, apellidos, sexo, fecha_nacimiento FROM pacientes WHERE id_paciente='$id'   ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


$consultaII = "SELECT fecha_hora_ingreso, fecha_hora_alta, motivo_ingreso, diagnostico FROM expedientes WHERE id_paciente=$id";
$resultadoII = $conexion->prepare($consultaII);
$resultadoII->execute();
$dataII=$resultadoII->fetchAll(PDO::FETCH_ASSOC);

?>


  
<button id="btnAtras" style="margin-left: 30px" type="button" class="btn btn-success" 
onclick="location.href='panel_defunsiones.php'"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</button>

<div class="container">


<hr>
<br>

<h1 align="center"> 
      Bitácora Del Paciente
</h1> 

<br>
<hr>
<h3 style="font-family: 'Montserrat', sans-serif;">DATOS</h3> 

    
        
    <style>
    .etiqueta{          
        font-size: 18px;  
        margin-bottom: 2px;
        font-family: 'Montserrat', sans-serif;
    }  
 
    .entrada{
        font-size: 18px; 
        font-family: 'Montserrat', sans-serif;
        width: 450px;
        background: transparent;
        border: 0;
        -moz-border-radius: 5px;  
        -webkit-border-radius: 5px;  
        border-radius: 5px;
        margin-bottom: 25px;  
        padding: 5px;  
    }

    </style>
    <br>


    
    <label for="fnacimiento" class="etiqueta">Nombre(s):</label>  
    <input type="text" id="fnacimiento" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['nombre'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="fnacimiento" class="etiqueta">Apellidos:</label>  
    <input type="text" id="fnacimiento" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['apellidos'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="sexo" class="etiqueta">Sexo:</label>  
    <input type="text" id="sexo" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['sexo'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="fnacimiento" class="etiqueta">Fecha De Nacimiento:</label>  
    <input type="text" id="fnacimiento" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['fecha_nacimiento'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="fingreso" class="etiqueta">Fecha & Hora De Ingreso:</label>  
    <input type="text" id="fingreso" name="fnacimiento"  class="entrada"
    value="<?php foreach($dataII as $datos) { ?> <?php echo $datos['fecha_hora_ingreso'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="mingreso" class="etiqueta">Motivo De Ingreso:</label>  
    <input type="text" id="mingreso" name="mnacimiento"  class="entrada"
    value="<?php foreach($dataII as $datos) { ?> <?php echo $datos['motivo_ingreso'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="diagnostico" class="etiqueta">Diagnostico:</label>  
    <input type="text" id="diagnostico" name="diagnostico"  class="entrada"
    value="<?php foreach($dataII as $datos) { ?> <?php echo $datos['diagnostico'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <hr>
<br>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_notificaciones.js"></script>  

    
</div>
<!--FIN del cont principal-->

<?php require_once "parte_inferior.php"?>