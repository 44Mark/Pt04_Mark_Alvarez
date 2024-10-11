<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('./header.php'); ?>
</head>
<body>

    <div id="iniciar-sesion">
        <h1>Inici Sessió</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="contenedor-input">
                <label>Correu electrònic</label>
                <input type="email" name="correo" required>
            </div>

            <div class="contenedor-input">
                <label>Contrasenya</label>
                <input type="password" name="contrasenya" required>
            </div>
            
            <input type=checkbox name="recordar" value="recordar">Recordar-me<br>
            <input type="submit" class="button button-block" value="Iniciar Sessió">
            
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include '../Controlador/verificarUsuari.php';
                $missatge = login($_POST['correo'], $_POST['contrasenya']);
                echo "<p class='missatge'>$missatge</p>";
            }
        ?>
    </div>
</body>
</html>