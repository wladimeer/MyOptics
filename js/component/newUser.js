Vue.component("new-user", {
    template: (`
        <form class="content__form">
            <div class="content__group">
                <label class="content__label" for="rut">Rut</label>
                <input type="text" class="content__input" id="rut" v-model="rut">
            </div>

            <div class="content__group">
                <label class="content__label" for="name">Nombre</label>
                <input type="text" class="content__input" id="name" v-model="name">
            </div>

            <div class="content__group">
                <label class="content__label" for="state">Estado</label>
                <select class="content__select" id="state" v-model="state">
                    <option v-for="state in states" v-bind:value="state.value">
                        {{ state.label }}
                    </option>
                </select>
            </div>                

            <div class="content__function">
                <button class="content__button" v-on:click="createUser">
                    Registrar Usuario
                </button>
            </div>

            <div class="content__result">
                <p class="content__message" v-html="message"
                    v-bind:class="{'message-success': message == 'El Usuario Se Registro'}">
                </p>
            </div>
        </form>
    `),
    data: function() {
        return {
            states: [
                {label: "Selecciona", value: ""},
                {label: "Habilitar", value: 1},
                {label: "Deshabilitar", value: 0}
            ], rut: "", name: "", state: "",
            message: ""
        }
    },
    methods: {
        createUser: async function(event) {
            event.preventDefault();

            try {
                var form = new FormData();
                form.append("rut", this.rut);
                form.append("name", this.name);                
                form.append("state", this.state);

                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/NewUser.php",
                    { method: "post", body: form }
                );

                if(response.ok) {
                    const received = await response.json();
                    
                    if(received == "El Usuario Se Registro") {
                        this.name = "", this.rut = "";
                        this.state = "", this.message = received;
                    } else {
                        this.message = received;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("NewUserException: " + exception);
            }
        }
    }
});