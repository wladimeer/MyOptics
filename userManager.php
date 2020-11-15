<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icon/eye-solid.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/styles.css">
    <title>Menu Principal</title>
</head>
<body>
    <div class="container">
        <div class="contentDrawing contentDrawing-Manager">
            <?php session_start(); ?>
            <?php if(isset($_SESSION["user"])) { ?>
                <header class="header header-Manager">
                    <div class="header__logo">
                        <h1>Mi óptica</h1>
                    </div>

                    <div class="header__options" id="options">
                        <a class="header__a" id="viewUser">Ver Usuarios</a>
                        <a class="header__a" id="newUser">Nuevo Usuario</a>
                        <a href="controller/SignOffUser.php" class="header__a">Cerrar Sesión</a>
                    </div>
                </header>

                <section class="content content-Manager" id="content"></section>
            <?php } ?>

            <?php if(!isset($_SESSION["user"])) { ?>
                <h4 class="refresh__title">Opps no sabemos como llegaste aqui</h4>
		        <p class="refresh__p">Seras redirecionado en 5 segundos...</p>
		        <meta http-equiv="refresh" content="5;URL=http://localhost/optics/index.php">
            <?php } ?>
        </div>
    </div>

    <script src="js/userManager.js" type="module"></script>
</body>
</html>