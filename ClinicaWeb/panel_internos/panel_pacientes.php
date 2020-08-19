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
onclick="location.href='panel_interno.php'"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</button>

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

<button id="btnNotificacion" type="button" class="btn btn-primary" data-toggle="modal"><i class="fas fa-check-square"></i> Agregar Notificación De Status </button>    

<form id="formNot" action="notificaciones.php" method="POST">  
<input type="hidden" class="form-control" id="id_paciente" name="id_paciente" value="<?php echo $id; ?>">         
<button id="btnEditar" type="submit" class="btn btn-danger"><i class="fas fa-users"></i> Ver Notificaciones </button>    

<button style="margin-left: 450px" id="btnAlta" type="button" data-toggle="modal" class="btn btn-success"><i class="fas fa-eject"></i> Dar De Alta </button>    
</form>


<!-- CODIGO PARA MODAL DE NOTIFICACIONES-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas" action="save_notificacion.php" method="POST">    
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo">
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <textarea name="descripcion" rows="4" cols="40" class="form-control" id="descripcion"></textarea>                
                </div>                                
                <div class="form-group">
                <label for="fecha" class="col-form-label">Fecha & Hora:</label>
                <input type="datetime-local" name=fecha class="form-control" id="fecha">
                </div>            
                
                <input type="hidden" class="form-control" name="id_paciente" value="<?php echo $id; ?>">
                <input type="hidden" class="form-control" name="nombre_interno" value="<?php echo $nombre." "; ?><?php echo $apellidos; ?>">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 

<!-- CODIGO PARA MODAL DE ALTA-->
<div class="modal fade" id="modalAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formAlta" action="save_alta.php" method="POST">    
            <div class="modal-body">
                <div class="form-group">
                <br>
                <label for="titulo" class="col-form-label">Motivo De Alta:</label>
                <br>
                <div>
	                <input type="radio" name="radio" id="defunsion" onclick="defunsion_date.disabled = false, estado_paciente.value='3'" >
                    <label for="defunsion">Defunsión</label>
                    <br>
                    <label for="defunsion">Fecha/Hora De Defunsión:</label>
	                <input type="datetime-local" name=defunsion_date class="form-control" id="fecha" disabled=true>
                </div>
                <br>
                <div>
	                <input type="radio" name="radio" id="recuperacion" onclick="defunsion_date.disabled = true, defunsion_date.value='', estado_paciente.value='2'">
	                <label for="recuperacion">Recuperación</label>            	    
                </div>
                <br>
                <div class="form-group">
                <label for="fecha_alta" class="col-form-label">Fecha & Hora De Alta:</label>
                <input type="datetime-local" name=fecha_alta class="form-control" id="fecha_alta">
                </div>            
                
                <div class="form-group">
                <label for="motivo_alta" class="col-form-label">Motivo De Alta:</label>
                <textarea name="motivo_alta" rows="4" cols="40" class="form-control" id="motivo_alta"></textarea>                
                </div>                                
                
                
                <input type="hidden" class="form-control" name="id_paciente" value="<?php echo $id; ?>">                
                <input type="hidden" class="form-control" name="estado_paciente">                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_notificaciones.js"></script>  

    
</div>
<!--FIN del cont principal-->

<?php require_once "parte_inferior.php"?>