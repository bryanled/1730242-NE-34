<?php require_once "parte_superior.php"?>

<?php

$id_externo=$_SESSION['id_externo'];

?>

<!--INICIO del cont principal-->
<br>
<div class="container">    
    <h1><i class="fa fa-address-book" aria-hidden="true"></i> Pacientes Asignados </h1>
</div>


<?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT a.id_paciente, a.nombre, a.apellidos, a.sexo, a.fecha_nacimiento, b.parentesco FROM pacientes AS a, asignaciones AS b
             WHERE a.id_paciente=b.id_paciente AND b.id_externo='$id_externo'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <!--<button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    -->
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>                            
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>                                                                
                                <th>Sexo</th>      
                                <th>Fecha De Nacimiento</th>                                 
                                <th>Parenteso</th> 
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>                            
                                <td><?php echo $dat['id_paciente'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['apellidos'] ?></td>
                                <td><?php echo $dat['sexo'] ?></td>
                                <td><?php echo $dat['fecha_nacimiento'] ?></td>                                                                    
                                <td><?php echo $dat['parentesco'] ?></td>                                                                    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_externo.js"></script> 



<?php require_once "parte_inferior.php"?>