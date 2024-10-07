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
            <input type="submit" class="button button-block" value="Iniciar Sessió">
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include '../Controlador/controlador.php';
                if (iniciarSessio($_POST['correo'], $_POST['contrasenya'])) {
                    header("Location: /BackEnd/Pt04_Mark_Alvarez/inici");
                    exit();
                } else {
                    global $missatge_error;
                    echo "<p class='missatge'>$missatge_error</p>";
                }
            }
        ?>
    </div>
    
</body>
</html>