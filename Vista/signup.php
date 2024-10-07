<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('./header.php'); ?>
</head>
<body>

    <div id="iniciar-sesion">
        <h1>Registrar-se</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="contenedor-input">
                <label>
                    Nom
                </label>
                <input type="text" name="nombre" required>
            </div>

            <div class="contenedor-input">
                <label>
                    Correu electrònic
                </label>
                <input type="email" name="correo" required>
            </div>

            <div class="contenedor-input">
                <label>
                    Contrasenya
                </label>
                <input type="password" name="contrasenya" required>
            </div>

            <div class="contenedor-input">
                <label>
                    Confirmació de contrasenya
                </label>
                <input type="password" name="confirmacio_contrasenya" required>
            </div>
            <input type="submit" class="button button-block" value="Registrar-se">
        </form>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../Controlador/controlador.php';
        $missatge = afegirUsuari($_POST['nombre'], $_POST['correo'], $_POST['contrasenya'], $_POST['confirmacio_contrasenya']);
        echo "<p class='missatge'>$missatge</p>";
    }
    ?>
    </div>
    
    
</body>
</html>