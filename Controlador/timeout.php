<?php

// Durada de 40 minuts
$inactiu = 40 * 60;

// Verifiquem si la sessió ha estat creada
if (isset($_SESSION['timeout'])) {
    // Calcula el temps transcorregut des de l'última activitat
    $temps = time() - $_SESSION['timeout'];
    // Si el temps transcorregut és major que el temps d'inactivitat(40 minuts), es tanca la sessió
    if ($temps > $inactiu) {
        session_unset();
        header("Location: index.php");
        $_SESSION['message'] = "Sessió finalitzada per inactivitat durant 40 minuts";
        exit();
    }
}
$_SESSION['timeout'] = time();
?>