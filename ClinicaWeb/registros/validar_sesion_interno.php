<?php

include_once '../BD/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$user = filter_input(INPUT_POST, 'user');
$password = filter_input(INPUT_POST, 'password');
$password=hash('sha512',$password);	


$consulta = "SELECT * FROM usuarios_internos where usuario='$user' AND contraseña='$password'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


$id = NULL;

?>
<?php                            
    foreach($data as $dat) {                                                        
?>    
     <?php $id = $dat['id_interno'] ?> 
<?php
    }
?> 

<?php                            
if($id!=NULL){
	
	session_start();

	$_SESSION['active']=true;
	
	?>
	<?php                            
    	foreach($data as $dat) {                                                        
    ?>                            		
		<?php 			
			$_SESSION['id_interno']=$dat['id_interno'];
			$_SESSION['nombre']=$dat['nombre'];
			$_SESSION['apellidos']=$dat['apellidos'];
			$_SESSION['sexo']=$dat['sexo'];			
			$_SESSION['correo']=$dat['correo'];			
			$_SESSION['cargo']=$dat['cargo'];						
			$_SESSION['usuario']=$dat['usuario'];
			$_SESSION['contraseña']=$dat['contraseña']; ?>
				
		<?php
			}
		?>                                						
			<?php

			header("Location:../panel_internos/panel_interno.php");
			exit(); 


}else{
	?>	
	<script src="../js/sesion_incorrectaI.js"></script>
	<?php
}

?>



