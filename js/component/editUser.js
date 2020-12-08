Vue.component("edit-user", {
    template: (`
        <form class="content__form">
            <div class="content__group">
                <label class="content__label" for="rut">Rut</label>
                <input type="text" class="content__input" readonly id="rut" v-model="rut">
            </div>

            <div class="content__group">
                <label class="content__label" for="name">Nombre</label>
                <input type="text" class="content__input" readonly id="name" v-model="name">
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
                <button class="content__button" v-on:keyup.enter="updateUser" 
                    v-on:click="updateUser">Actualizar Usuario
                </button>
            </div>

            <div class="content__result">
                <p class="content__message" v-html="message"
                    v-bind:class="{'message-success': message == 'El Usuario Se Actualizo'}">
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
    computed: {
        ...Vuex.mapGetters({ userData: "userData" })
    },
    mounted: function() {
        this.rut = this.userData[0];
        this.name = this.userData[1];
        this.state = this.userData[2];
    },
    methods: {
        updateUser: async function(event) {
            event.preventDefault();

            try {
                var form = new FormData();
                form.append("rut", this.rut);
                form.append("name", this.name);
                form.append("state", this.state);

                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/EditUser.php",
                    { method: "post", body: form }
                );

                if(response.ok) {
                    const received = await response.json();

                    if(received == "El Usuario Se Actualizo") {
                        this.message = received;
                        this.rut = "", this.name = "";
                        this.state = "";
                    } else {
                        this.message = received;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("EditUserException: " + exception);
            }    
        }
    }
});