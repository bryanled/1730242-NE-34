<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
  <link rel="stylesheet" href="css/registro.css">  
</head>


<body class="align">
  <div class="grid">
    <div id="login">

      <h2 style="text-allign">Bienvenido Interino</h2>
            

      <form action="registros/validar_sesion_interno.php" method="POST">

        <fieldset>
          
          <p><label for="user">Usuario:</label></p>
          <p><input type="text" id="user" name="user" placeholder="Nombre de Usuario"></p>

          <p><label for="password">Contraseña</label></p>
          <p><input type="password" id="password" name="password" placeholder="password"></p>                                                  
          <br>
          <p><input type="submit" value="Iniciar Sesion"></p>
          <a href="seleccion_usuario.html" style="text-decoration: none"><p><input type="button" 
          style="background: #1558e9; color: #fff; display: block; margin: 0 auto; padding: 4px 0; ;width: 100%;" value="Cancelar"></p></a>
          
        </fieldset>

      </form>

    </div> <!-- end login -->

  </div>

</body>	