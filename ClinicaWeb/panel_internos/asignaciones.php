<?php require_once "parte_superior.php"?>



<div class="container">
    <h1> Asignacion De Pacientes</h1>
    
    
 <?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT a.id_paciente, CONCAT(a.nombre, ' ', a.apellidos) AS Nombre, LEFT((b.fecha_hora_ingreso),10) AS Fecha 
            FROM pacientes AS a, expedientes AS b WHERE a.id_paciente=b.id_paciente AND a.id_estado_p=1 ";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


$consultaII = "SELECT id_externo, CONCAT(nombre, ' ', apellidos) AS Nombre, usuario, correo FROM usuarios_externos";

$resultadoII = $conexion->prepare($consultaII);
$resultadoII->execute();
$dataII=$resultadoII->fetchAll(PDO::FETCH_ASSOC);



?>



<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <!--<button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    -->
            </div>    
        </div>    
    </div>    
    <br>  


<h3>Pacientes</h3>
<div class="container">
    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr >
      <th class="th-sm">ID
      </th>
      <th class="th-sm">Nombre
      </th>     
      <th class="th-sm">Fecha De Ingreso    
      </th>      
      <th class="th-sm">Acciones
      </th>
    </tr>
  </thead>
  <tbody>

  <?php                            
    foreach($data as $dat) {                                                        
    ?>                            
    <tr>  
        <td><?php echo $dat['id_paciente'] ?></td>
        <td><?php echo $dat['Nombre'] ?></td>
        <td><?php echo $dat['Fecha'] ?></td>        
        <td></td>
    </tr>                                                                                                                       
        <?php
    }
    ?>        
  </tbody>
</table>
</div>
<br>

<label style="margin-left: 10px" for="fnacimiento" class="etiqueta">Nombre Del Paciente Asignado :</label>  
<input type="text" id="paciente_asignado" name="paciente_asignado"  class="entrada" disabled="disabled"/> 
<br>
<br>
<br>
<br>


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

    






<h3>Usuarios Externos</h3>
<div class="container">
    <table id="dtVerticalScrollExampleII" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
  <thead>
    <tr >
      <th class="th-sm">ID
      </th>
      <th class="th-sm">Nombre
      </th>
      <th class="th-sm">Username
      </th>
      <th class="th-sm">Correo
      </th>      
      <th class="th-sm">Acciones
      </th>
    </tr>
  </thead>
  <tbody>

  <?php                            
    foreach($dataII as $datII) {                                                        
    ?>                            
    <tr>  
        <td><?php echo $datII['id_externo'] ?></td>
        <td><?php echo $datII['Nombre'] ?></td>
        <td><?php echo $datII['usuario'] ?></td>
        <td><?php echo $datII['correo'] ?></td>        
        <td></td>
    </tr>                                                                                                                       
        <?php
    }
    ?>        
  </tbody>
</table>
</div>
<br>

<label style="margin-left: 10px" for="fnacimiento" class="etiqueta">Nombre Del Usuario Asignado :</label>  
<input type="text" id="usuario_asignado" name="usuario_asignado"  class="entrada" disabled="disabled"/> 
<br>
<br>

<form id="formAsignacion" action="save_asignacion.php" method="POST">    
    
    <input type="hidden" class="form-control" name="id_paciente" id="id_paciente">                
    <input type="hidden" class="form-control" name="id_externo" id="id_externo">                

    <label style="margin-left: 10px" for="fnacimiento" class="etiqueta">Introduzca El Parentesco :</label>          
    <input type="text" id="parentesco" name="parentesco"  class="entrada"/>     
    <button id="btnAtras" style="margin-left: 170px" type="submit" class="btn btn-success"><i class="fas fa-users"></i> Guardar Asignación</button>
</form>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_asignaciones.js"></script> 

<?php require_once "parte_inferior.php"?>

