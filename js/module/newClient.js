export default {
    form: (`
        <form class="content__form" id="form">
            <div class="content__inputs">
                <label class="content__label" for="rut">Rut</label>
                <input type="text" class="content__input" id="rut" name="rut">
            </div>

            <div class="content__inputs">
                <label class="content__label" for="name">Nombre</label>
                <input type="text" class="content__input" id="name" name="name">
            </div>

            <div class="content__inputs">
                <label class="content__label" for="name">Dirección</label>
                <input type="text" class="content__input" id="address" name="address">
            </div>

            <div class="content__inputs">
                <label class="content__label" for="name">Telefono</label>
                <input type="number" class="content__input" id="phone" name="phone">
            </div>

            <div class="content__inputs">
                <label class="content__label" for="name">Fecha</label>
                <input type="date" class="content__input" id="date" name="date">
            </div>

            <div class="content__inputs">
                <label class="content__label" for="name">Correo</label>
                <input type="email" class="content__input" id="email" name="email">
            </div>

            <div class="content__function">
                <button type="submit" class="content__button">
                    Registrar Cliente
                </button>
            </div>

            <div class="content__result">
                <p class="content__message" id="result"></p>
            </div>
        </form>
    `),
    create: function() {
        var form = document.getElementById("form");

        form.addEventListener("submit", function() {
            var result = document.getElementById("result");
            var inputs = new FormData(form);
            
            try {
                fetch("https://opticsapp.herokuapp.com/NewClient.php", {
                    method: "post",
                    body: inputs
                })
                .then(response => response.json())
                .then(received => {
                    if(received == "Registrado") {
                        result.style.color = "green";
                        result.innerHTML = "Cliente Registrado";
                        document.getElementById("rut").value = "";
                        document.getElementById("name").value = "";
                        document.getElementById("address").value = "";
                        document.getElementById("phone").value = "";
                        document.getElementById("date").value = "";
                        document.getElementById("email").value = "";
                    } else {
                        result.style.color = "red";
                        result.innerHTML = received;
                    }
                })
                .catch(() => {
                    console.log("There Was a Mistake");
                });
            } catch (exception) {
                console.log("Exception: " + exception);
            }

            event.preventDefault();
        });
    }
};