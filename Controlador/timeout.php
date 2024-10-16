<?php

// Configurar la duración de la sesión a 10 segundos para pruebas
$inactiu = 40 * 60;

// Verificar si la sesión está activa
if (isset($_SESSION['timeout'])) {
    $temps = time() - $_SESSION['timeout'];
    if ($temps > $inactiu) {
        session_unset();
        header("Location: index.php");
        $_SESSION['message'] = "Sessió finalitzada per inactivitat durant 40 minuts";
        exit();
    }
}
$_SESSION['timeout'] = time();
?>