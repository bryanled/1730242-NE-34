<?php require_once "parte_superior.php"?>


<!--INICIO del cont principal-->
    
    
 <?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$id = $_GET["id"];



$consulta = "SELECT id_notificacion, titulo, detalle, nombre_interno, fecha, id_paciente, id_estado_n FROM notificacion WHERE id_notificacion='$id'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>



  
<button id="btnAtras" style="margin-left: 30px" type="button" class="btn btn-success" 
onclick="location.href='panel_interno.php'"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</button>

<div class="container">


<hr>
<br>

<h2> 
      Detalle De Status
</h2> 

<br>
<hr>


    
        
    <style>
    .etiqueta{          
        font-size: 18px;  
        margin-bottom: 2px;
        font-family: 'Montserrat', sans-serif;
    }  
 
    .entrada{
        font-size: 18px; 
        font-family: 'Montserrat', sans-serif;
        width: 1000px;
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


    
    <label style="font-size: 30px;" for="fnacimiento" class="etiqueta">Titulo:</label>  
    <input type="text" id="ftitulo" name="fnacimiento"  style="font-size: 30px;" class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['titulo'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label style="font-size: 20px;" for="fnacimiento" class="etiqueta">Detalle:</label>  
    <input type="text" id="fdetalle" name="fnacimiento" style="font-size: 20px;" class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['detalle'] ?><?php } ?>" disabled="disabled"/> 
    <br>    
    <hr>
    <label for="fnacimiento" class="etiqueta">Fecha & Hora De Generacion:</label>  
    <input type="text" id="ffecha" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['fecha'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    <label for="sexo" class="etiqueta">Emitada Por:</label>  
    <input type="text" id="sexo" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['nombre_interno'] ?><?php } ?>" disabled="disabled"/> 
    <br>
    
    <hr>
<br>



</div>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_pnotificaciones.js"></script>  

    

<!--FIN del cont principal-->

<?php require_once "parte_inferior.php"?>