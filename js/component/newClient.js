Vue.component("new-client", {
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
                <label class="content__label" for="name">Dirección</label>
                <input type="text" class="content__input" id="address" v-model="address">
            </div>

            <div class="content__group">
                <label class="content__label" for="name">Telefono</label>
                <input type="number" class="content__input" id="phone" v-model="phone">
            </div>

            <div class="content__group">
                <label class="content__label" for="name">Fecha</label>
                <input type="date" class="content__input" id="date" v-model="date">
            </div>

            <div class="content__group">
                <label class="content__label" for="name">Correo</label>
                <input type="email" class="content__input" id="email" v-model="email">
            </div>

            <div class="content__function">
                <button class="content__button" v-on:click="createClient">
                    Registrar Cliente
                </button>
            </div>

            <div class="content__result">
                <p class="content__message" v-html="message"
                    v-bind:class="{'message-success': message == 'El Cliente Se Registro'}">
                </p>
            </div>
        </form>
    `),
    data: function() {
        return {
            rut: "", name: "", address: "",
            phone: "", date: "", email: "", 
            message: ""
        }
    },
    methods: {
        createClient: async function(event) {
            event.preventDefault();

            try {
                var form = new FormData();
                form.append("rut", this.rut);
                form.append("name", this.name);
                form.append("address", this.address);
                form.append("phone", this.phone);
                form.append("date", this.date);
                form.append("email", this.email);

                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/NewClient.php",
                    { method: "post", body: form }
                );

                if(response.ok) {
                    const received = await response.json();
                    
                    if(received == "El Cliente Se Registro") {
                        this.rut = "", this.name = "";
                        this.address = "", this.phone = "";
                        this.date = "", this.email = "";
                        this.message = received;
                    } else {
                        this.message = received;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("NewClientException: " + exception);
            }
        }
    }
});