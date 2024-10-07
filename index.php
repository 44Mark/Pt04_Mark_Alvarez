<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('./Vista/header.php'); ?>
</head>
<body>
    <h1>Descobreix i comparteix els teus llibres preferits</h1>
    <h2><?php if (isset($_SESSION['nom'])) echo 'Benvingut ' . $_SESSION['nom'] . '!!'; ?></h2>
</body>
</html>