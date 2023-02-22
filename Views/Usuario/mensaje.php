<link rel="stylesheet" href="../css/style.css">

<?php

if (isset($mensaje)) {
    echo $mensaje;
}
?>

<a href="<?=$_ENV['base_url'] ?>usuario_registro">Registrarse</a>
<a href="<?=$_ENV['base_url'] ?>usuario_login">Iniciar_sesion</a>

