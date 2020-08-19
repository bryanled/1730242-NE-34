<?php require_once "parte_superior.php"?>


s


<?php
include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = $_GET["id"];

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
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>                                    
                                <?php if($dat['id_estado_n']=='1'){ ?>
                                <td style="background-color: #B8F1D9  "><?php echo $dat['id_notificacion'] ?></td>
                                <td style="background-color: #B8F1D9  "><?php echo $dat['titulo'] ?></td>
                                <td style="background-color: #B8F1D9  "><?php echo $dat['fecha'] ?></td>
                                <td style="background-color: #B8F1D9  "><?php echo $dat['nombre_interno'] ?></td>                                
                                <td style="background-color: #B8F1D9  "></td>                           
                                <?php }else{ ?>    
                                <td><?php echo $dat['id_notificacion'] ?></td>
                                <td><?php echo $dat['titulo'] ?></td>
                                <td><?php echo $dat['fecha'] ?></td>
                                <td><?php echo $dat['nombre_interno'] ?></td>                                
                                <td></td>                               
                                <?php } ?>    
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="../js/main_pnotificaciones.js"></script> 

                            

<?php require_once "parte_inferior.php"?>