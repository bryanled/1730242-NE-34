<?php require_once "parte_superior.php"?>

<?php 

$nombre=$_SESSION['nombre'];
$apellidos=$_SESSION['apellidos'];

?>


<?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = $_POST['id_paciente'];


$consulta = "SELECT id_notificacion, titulo, fecha, nombre_interno, id_estado_n FROM notificacion WHERE id_paciente='$id'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


$consultaII = "SELECT CONCAT(nombre, ' ',apellidos) AS nombre_c FROM pacientes WHERE id_paciente='$id'";

$resultadoII = $conexion->prepare($consultaII);
$resultadoII->execute();
$dataII=$resultadoII->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
<h1>Notificaciones De Status Del Paciente:</h1> 
<?php                            
    foreach($dataII as $dat) {                                                        
?>    
    <h3><?php echo $dat['nombre_c'] ?></h3> 
<?php
    }
?> 

<br>

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
                                <th>Titulo</th>
                                <th>Fecha & Hora</th>                                                                
                                <th>Generada Por</th>                                      
                                <th>Estado</th> 
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>                                                                       
                                <td><?php echo $dat['id_notificacion'] ?></td>
                                <td><?php echo $dat['titulo'] ?></td>
                                <td><?php echo $dat['fecha'] ?></td>
                                <td><?php echo $dat['nombre_interno'] ?></td>                                
                                <?php if($dat['id_estado_n']=='1'){ ?>
                                <td><?php echo "No Vista" ?></td>
                                <?php }else{ ?> 
                                <td><?php echo "Vista" ?></td>
                                <?php } ?>    
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
        </div>



<!-- CODIGO PARA MODAL DE NOTIFICACIONES-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas" action="update_notificacion.php" method="POST">    
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo">
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <textarea name="descripcion" rows="4" cols="40" class="form-control" id="descripcion"></textarea>                
                </div>                                
                <div class="form-group">
                <label for="fecha" class="col-form-label">Fecha & Hora:</label>
                <input type="datetime-local" name=fecha class="form-control" id="fecha">
                </div>        
                    
                <input type="hidden" class="form-control" name="id_notificacion" id="id_notificacion">                                
                <input type="hidden" class="form-control" name="nombre_interno" value="<?php echo $nombre." "; ?><?php echo $apellidos; ?>">
                <input type="hidden" class="form-control" name="id_paciente" value="<?php echo $id; ?>">
                
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
<script type="text/javascript" src="../js/main_notifiaciones_int.js"></script> 

                            

<?php require_once "parte_inferior.php"?>