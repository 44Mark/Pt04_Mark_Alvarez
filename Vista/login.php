<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('./header.php'); ?>
</head>
<body>

    <div id="iniciar-sessio">
        <h1>Inici Sessió</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="contenedor-input">
                <label>Correu electrònic</label>
                <input type="email" name="correu" value="<?php echo isset($_POST['correu']) ? htmlspecialchars($_POST['correu']) : ''; ?>" required>
            </div>

            <div class="contenedor-input">
                <label>Contrasenya</label>
                <input type="password" name="contrasenya" required>
            </div>
            
            <input type="checkbox" name="recordar" value="recordar">Recordar-me<br>
            <input type="submit" class="button button-block" value="Iniciar Sessió">
        </form>
        <?php
            // Si s'ha enviat el formulari, cridem a la funció login
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include '../Controlador/verificarUsuari.php';
                login($_POST['correu'], $_POST['contrasenya']);
            }
            // Si hi ha un missatge, el mostrem
            if (isset($_SESSION['message'])) {
                $missatge = $_SESSION['message'];
                echo "<p class='missatge'>$missatge</p>";
                unset($_SESSION['message']);
            }
        ?>
    </div>
</body>
</html>