<?php
ini_set('session.cookie_lifetime', 0);

session_start();
if (isset($_SESSION['correu'])) {
    $usuari_autenticat = true;
} else {
    $usuari_autenticat = false;
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Llibreria</title>
<base href="/BackEnd/Pt04_Mark_Alvarez/">
<link rel="stylesheet" href="Vista/estils.css">

<nav class="navbar superior">
    <span>MÓN DE LLIBRES </span>
</nav>

<nav class="navbar inferior">
    <div>
        <a href="/BackEnd/Pt04_Mark_Alvarez/inici">Inici</a>
        <a href="/BackEnd/Pt04_Mark_Alvarez/gestio">Gestió de Llibres</a>
    </div>

    <div class="dropdown">
        <img src="./Images/logo.png" style="height: 35px;">
        <div class="dropdown-content">
            <?php if ($usuari_autenticat == true): ?>
                <a href="">Modificar compte</a>
                <a href="/BackEnd/Pt04_Mark_Alvarez/logout" >Sortir</a>
            <?php else: ?>
                <a href="/BackEnd/Pt04_Mark_Alvarez/login">Login</a>
                <a href="/BackEnd/Pt04_Mark_Alvarez/signup">Sign up</a>
            <?php endif; ?>
        </div>
    </div>
</nav>