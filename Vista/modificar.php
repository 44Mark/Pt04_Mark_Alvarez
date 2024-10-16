<!-- Mark Alvarez -->
<!DOCTYPE html>
<html lang="es">
<head>
    
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('./header.php'); 
?>
</head> 
<body>
    <h1>Modificació de Llibres</h1>
    <div id="iniciar-sessio">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="insert">  
            <input type="hidden" name="accion" value="actualitzarLlibre">

            <div class="contenedor-input">
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" value="<?php echo isset($_SESSION['isbn']) ? htmlspecialchars($_SESSION['isbn']) : ''; ?>" readonly>
            </div>

            <div class="contenedor-input">
                <label for="titol">Titol:</label>
                <input type="text" id="titol" name="titol" value="<?php echo isset($_SESSION['titol']) ? htmlspecialchars($_SESSION['titol']) : ''; ?>" required>
            </div>

            <div class="contenedor-input">
                <label for="cos">Cos:</label>
                <textarea name="cos" rows="8" cols="38" required><?php echo isset($_SESSION['cos']) ? htmlspecialchars($_SESSION['cos']) : ''; ?></textarea>
            </div>

            <input type="submit" value="Actualitzar" class="button" onclick="return confirm('Estàs segur que vols actualitzar?');">
        </form>
        
        <button class="button" onclick="window.location.href='./index.php';">Tornar al menú</button>

        <?php
        // Si s'ha enviat el formulari, cridem a la funció comprovactualitzarLlibre
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include('../Controlador/modificarLlibre.php');
            $missatge = comprovactualitzarLlibre($_POST['isbn'], $_POST['titol'], $_POST['cos'], $_SESSION['correu']);
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
