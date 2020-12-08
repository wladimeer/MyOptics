<!DOCTYPE html>
<html lang="es">
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
    <div class="container" id="app">
        <div class="contentDrawing contentDrawing-Index">
            <header class="header header-Index">
                <div class="header__logo">
                    <h1>Mi óptica</h1>
                </div>

                <div class="header__intent">
                    <h3 class="header__h3">Acceso Usuario</h3>
                </div>
            </header>

            <section class="content content-Index">
                <div class="content__form">
                    <div class="content__group">
                        <label class="content__label" for="rut">Usuario</label>
                        <input type="text" class="content__input" placeholder="Ingresa Rut Usuario" 
                            id="rut" v-model="rut" v-on:keyup.enter="login" autofocus>
                    </div>

                    <div class="content__group">
                        <label class="content__label" for="password">Contraseña</label>
                        <input type="password" class="content__input" placeholder="Ingresa Contraseña" 
                            id="password" v-model="password" v-on:keyup.enter="login">
                    </div>

                    <div class="content__function">
                        <button class="content__button" v-on:click="login">Iniciar Sesión</button>
                    </div>

                    <div class="content__result">
                        <p class="content__message" v-html="message"
                            v-bind:class="{'message-success': message == 'Iniciando Sesión...'}">
                        </p>
                    </div>
                </div>
            </section>

            <footer class="footer">
                <p class="footer__p">Created by Sebastián Benavides Cartes | 2020</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="js/loginUser.js"></script>
</body>
</html>