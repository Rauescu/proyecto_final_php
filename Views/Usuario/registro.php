<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') :  ?>
    <strong class="alert_green">Registro completado correctamente</strong>

<?php endif; ?>
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') :  ?>
    <strong class="alert_green">Registro completado correctamente</strong>

<?php endif; ?>

<h1>Registro</h1>
<form action="usuario_guardar" method="POST">
    <label for="nombre">Nombre</label>
    <input required type="text" name="data[nombre]" required>
    <br>
    <label for="apellidos">Apellidos</label>
    <input required type="text" name="data[apellidos]" required>
    <br>
    <label for="email">Email</label>
    <input required type="text" name="data[email]" required>
    <br>
    <label for="password">Password</label>
    <input required type="text" name="data[password]" required title="min 8car -> Xx0!">
    <br>
    <input type="submit" value="Enviar">
</form>