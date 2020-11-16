export default {
    form: (`
        <form class="content__form" id="form">
            <div class="content__inputs">
                <label class="content__label" for="rut">Rut</label>
                <input type="text" class="content__input" readonly id="rut" name="rut">
            </div>

            <div class="content__inputs">
                <label class="content__label" for="name">Nombre</label>
                <input type="text" class="content__input" readonly id="name" name="name">
            </div>

            <div class="content__inputs">
                <select name="state" id="state" class="content__select"></select>
            </div>

            <div class="content__function">
                <button type="submit" class="content__button">
                    Actualizar Usuario
                </button>
            </div>

            <div class="content__result">
                <p class="content__message" id="result"></p>
            </div>
        </form>
    `),
    inputs: [
        {label: "Selecciona", value: ""},
        {label: "Habilitar", value: 1},
        {label: "Deshabilitar", value: 0}
    ],
    loadStates: function() {
        var state = document.getElementById("state");

        this.inputs.forEach(item => {
            var option = document.createElement("option");
            option.setAttribute("label", item.label);
            option.setAttribute("value", item.value);
            state.appendChild(option);
        });
    },
    update: function() {
        var form = document.getElementById("form");
        
        form.addEventListener("submit", function() {
            var result = document.getElementById("result");
            var inputs = new FormData(form);
            
            try {
                fetch("https://opticsapp.herokuapp.com/controller/EditUser.php", {
                    method: "post",
                    body: inputs
                })
                .then(response => response.json())
                .then(received => {
                    if(received == "Actualizado") {
                        result.style.color = "green";
                        result.innerHTML = "Usuario Actualizado";
                        document.getElementById("rut").value = "";
                        document.getElementById("name").value = "";
                        document.getElementById("state").value = "";
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