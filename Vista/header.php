<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llibreria</title>
    <base href="/BackEnd/Pt04_Mark_Alvarez/">
    <link rel="stylesheet" href="Vista/estils.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true): ?> 
                <a href="/BackEnd/Pt04_Mark_Alvarez/inici">Inici</a>
                <a href="/BackEnd/Pt04_Mark_Alvarez/insert">Insertar nou llibre</a>
            <?php else: ?>
                <a href="/BackEnd/Pt04_Mark_Alvarez/inici">Inici</a>  
            <?php endif; ?>
        </div>
        <div class="navbar-center">
            <span class="fixed-title">MÓN DE LLIBRES</span>
        </div>
        <div class="navbar-right">
            <div class="dropdown">
                <img src="Images/logo.png" style="height: 35px;">
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['usuari_autenticat']) && $_SESSION['usuari_autenticat'] == true): ?> 
                        <a href="">Modificar compte</a>
                        <a href="/BackEnd/Pt04_Mark_Alvarez/logout">Sortir</a>
                    <?php else: ?>
                        <a href="/BackEnd/Pt04_Mark_Alvarez/login">Login</a>
                        <a href="/BackEnd/Pt04_Mark_Alvarez/signup">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>