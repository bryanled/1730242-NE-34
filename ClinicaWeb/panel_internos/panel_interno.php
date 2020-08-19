<?php require_once "parte_superior.php"?>



<!--INICIO del cont principal-->
<div class="container">
    <h1><button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">+</button> Pacientes</h1>
    
    
 <?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT id_paciente, nombre, apellidos, sexo,fecha_nacimiento FROM pacientes WHERE id_estado_p='1'";
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
    
<!-- CODIGO PARA MODAL-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas" action="save_paciente.php" method="POST">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre">
                </div>
                <div class="form-group">
                <label for="apellidos" class="col-form-label">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos">
                </div>
                <div class="form-group">
                <label for="sexo" class="col-form-label">Sexo:</label>
                <br>
                    <input type="radio" name="sexo" value="Hombre" required> Hombre
                    <input type="radio" name="sexo" value="Mujer" required> Mujer                
                </div>
                <div class="form-group">
                <label for="fecha_n" class="col-form-label">Fecha De Nacimiento:</label>
                <input type="date" name=fecha_n class="form-control" id="fecha_n">
                </div>    
                <div class="form-group">
                <label for="fecha_i" class="col-form-label">Fecha & Hora De Ingreso:</label>
                <input type="datetime-local" name=fecha_i class="form-control" id="fecha_i">
                </div>                    
                <div class="form-group">
                <label for="motivo" class="col-form-label">Motivo De Ingreso:</label>
                <input type="text" class="form-control" name="motivo">
                </div>
                <div class="form-group">
                <label for="diagnostico" class="col-form-label">Diagnostico:</label>
                <textarea name="diagnostico" rows="4" cols="40" class="form-control" id="diagnostico"></textarea>                
                </div>                   

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 







<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_interno.js"></script> 
    
</div>
<!--FIN del cont principal-->

<?php require_once "parte_inferior.php"?>
