<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icon/eye-solid.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/styles.css">
    <title>Mi óptica</title>
</head>
<body>
    <div class="container">
        <div class="contentDrawing contentDrawing-Index">
            <header class="header header-Index">
                <div class="header__logo">
                    <!-- <h1>Mi óptica</h1> -->
                    <img src="image/logo-optics.svg" alt="logo">
                </div>

                <div class="header__intent">
                    <h3 class="header__h3">Acceso Usuario</h3>
                </div>
            </header>

            <section class="content content-Index">
                <form class="content__form" id="form">
                    <div class="content__inputs">
                        <label class="content__label" for="rut">Usuario</label>
                        <input type="text" class="content__input" placeholder="Ingresa Rut Usuario" id="rut" name="rut">
                    </div>

                    <div class="content__inputs">
                        <label class="content__label" for="password">Contraseña</label>
                        <input type="password" class="content__input" placeholder="Ingresa Contraseña" id="password" name="password">
                    </div>

                    <div class="content__function">
                        <button type="submit" class="content__button">Iniciar Sesión</button>
                    </div>

                    <div class="content__result">
                        <p class="content__message" id="result"></p>
                    </div>
                </form>
            </section>

            <footer class="footer">
                <p class="footer__p">Created by Sebastián Benavides Cartes | 2020</p>
            </footer>
        </div>
    </div>

    <script src="js/loginUser.js"></script>
</body>
</html>