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
onclick="location.href='panel_externo.php'"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</button>

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


<form action="update_notificacion.php" method="POST">    
    <label style="font-size: 30px;" for="fnacimiento" class="etiqueta">Titulo:</label>  
    <input type="text" id="fnacimiento" name="fnacimiento"  style="font-size: 30px;" class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['titulo'] ?><?php } ?>"/> 
    <br>
    <label style="font-size: 20px;" for="fnacimiento" class="etiqueta">Detalle:</label>  
    <input type="text" id="fnacimiento" name="fnacimiento" style="font-size: 20px;" class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['detalle'] ?><?php } ?>"/> 
    <br>    
    <hr>
    <label for="fnacimiento" class="etiqueta">Fecha & Hora De Generacion:</label>  
    <input type="text" id="fnacimiento" name="fnacimiento"  class="entrada"
    value="<?php foreach($data as $dat) { ?> <?php echo $dat['fecha'] ?><?php } ?>"/> 
    <br>        
    <hr>
<br>
</form>


     
<button id="btnEditar" type="submit" class="btn btn-primary"><i class="fas fa-users"></i> Editar </button>    
<button id="btnEliminar" type="button" data-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar </button>    



</div>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_notificaciones.js"></script>  

    

<!--FIN del cont principal-->

<?php require_once "parte_inferior.php"?>