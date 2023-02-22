

<?php if(!isset($_SESSION['identity'])): ?>
<h1>LOGIN</h1>
<form action="usuario_iniciar" method="POST">
    <label for="email">Email</label>
    <input required type="email" name="data[email]"/>
    <label for="password">Password</label>
    <input required type="password" name="data[password]"/>
    <input type="submit" value="Enviar"/>
</form>


<?php else: ?>

<h3><?=$_SESSION['identity']->nombre?><?=$_SESSION['identity']->apellidos?></h3>

<?php endif; ?>