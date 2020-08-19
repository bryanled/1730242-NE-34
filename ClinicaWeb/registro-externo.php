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

      <h2 style="text-allign">Bienvenido</h2>

      <form action="registros/save-externo.php" method="POST">

        <fieldset>

          <p><label for="nombre">Nombre:</label></p>
          <p><input type="text" id="nombre" name="nombre" placeholder="Nombre" required></p>

          <p><label for="apellidos">Apellidos:</label></p>
          <p><input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required></p>
              
          <p><label for="correo">Correo:</label></p>
          <p><input type="email" id="correo" name="correo" placeholder="mail@address.com" required></p>
                    
          <p><label for="fechaNacimiento">Fecha de Nacimiento:</label></p>       
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required></p>

          <p><label for="user">Usuario:</label></p>
          <p><input type="text" id="user" name="user" placeholder="Nombre de Usuario" required></p>

          <p><label for="password">Contraseña</label></p>
          <p><input type="password" id="password" name="password" placeholder="password" required></p>
                              
          <p>Sexo:</p>
            <p><input type="radio" name="sexo" value="Hombre" required> Hombre
              <input type="radio" name="sexo" value="Mujer" required> Mujer </p>
          </p>
              
          <p><input type="submit" value="Registrarse"></p>
          <a href="index.html" style="text-decoration: none"><p><input type="button" 
          style="background: #1558e9; color: #fff; display: block; margin: 0 auto; padding: 4px 0; ;width: 100%;" value="Cancelar"></p></a>
          

        </fieldset>

      </form>

    </div> <!-- end login -->

  </div>

</body>	