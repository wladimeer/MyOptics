Vue.component("new-recipe", {
    template: (`
        <form class="content__form">
            <div class="content__group">
                <label class="content__label" for="rut_client">Rut Cliente</label>
                <input type="text" class="content__input" id="rut_client" v-on:keyup="searchClient" v-model="rut_client">
            </div>

            <table class="content__table" border="1">
                <thead>
                    <tr v-if="rut != ''">
                        <th class="content__th">Rut</th>
                        <th class="content__th">Nombre</th>
                        <th class="content__th">Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="content__tr" v-if="rut != ''">
                        <td class="content__td" data-label="Rut:">{{ rut }}</td>
                        <td class="content__td" data-label="Nombre:">{{ name }}</td>
                        <td class="content__td" data-label="Correo:">{{ email }}</td>
                    </tr>
                    
                    <tr class="content__tr" v-if="rut == ''">
                        <td class="content__td" data-label="Resultado:" colspan="4">Sin Resultados</td>
                    </tr>
                </tbody>
            </table>
                    
            <div class="content_checkbox">
                <label class="content__label">Tipo de Lente</label>

                <div class="content__options">
                    <div class="content__option">
                        <input class="content__checkbox" type="checkbox" value="Cerca" v-model="lens_type">Cerca
                    </div>

                    <div class="content__option">
                        <input class="content__checkbox" type="checkbox" value="Lejos" v-model="lens_type">Lejos
                    </div>
                </div>
            </div>

            <div class="content__inputs">
                <div class="content__text">
                    <label class="content__label">Ojo Izquierdo</label>
                </div>
                
                <div class="inputs__groups">
                    <input class="input__group" type="text" required pattern="[+-]+[0-9].[0-9]{2,2}" 
                        placeholder="Esfera" title="Ejemplo +0.25 o -0.25" v-model="sphere_left">
                    <input class="input__group" type="text" required pattern="[+-]+[0-9].[0-9]{2,2}" 
                        placeholder="Cilindro" title="Ejemplo +0.25 o -0.25" v-model="cylinder_left">
                    <input class="input__group" type="number" placeholder="Eje" v-model="axis_left">
                </div>
            </div>

            <div class="content__inputs">
                <div class="content__text">
                    <label class="content__label">Ojo Derecho</label>
                </div>

                <div class="inputs__groups">
                    <input class="input__group" type="text" required pattern="[+-]+[0-9].[0-9]{2,2}" 
                        placeholder="Esfera" title="Ejemplo +0.25 o -0.25" v-model="sphere_right">
                    <input class="input__group" type="text"  required pattern="[+-]+[0-9].[0-9]{2,2}" 
                        placeholder="Cilindro" title="Ejemplo +0.25 o -0.25" v-model="cylinder_right">
                    <input class="input__group" type="number" placeholder="Eje" v-model="axis_right">
                </div>
            </div>

            <div class="content__group">
                <label class="content__label" for="crystal_type">Tipo de Cristal</label>
                <select class="content__select" id="crystal_type" v-model="type">
                    <option value="">Selecciona</option>
                    <option v-for="type in crystal_types" v-bind:value="type.id">
                        {{ type.type }}
                    </option>
                </select>
            </div>

            <div class="content__group">
                <label class="content__label" for="crystal_material">Material del Cristal</label>
                <select class="content__select" id="crystal_material" v-model="material">
                    <option value="">Selecciona</option>
                    <option v-for="material in crystal_materials" v-bind:value="material.id">
                        {{ material.material }}
                    </option>
                </select>
            </div>

            <div class="content__group">
                <label class="content__label" for="base">Base</label>
                <select class="content__select" id="base" v-model="base">
                    <option value="">Selecciona</option>
                    <option value="Inferior">Inferior</option>
                    <option value="Superior">Superior</option>
                    <option value="Interna">Interna</option>
                    <option value="Externa">Externa</option>
                </select>
            </div>
            
            <div class="content__group">
                <label class="content__label" for="frame">Armazón</label>
                <select class="content__select" id="frame" v-model="frame">
                    <option value="">Selecciona</option>
                    <option v-for="frame in frames" v-bind:value="frame.id">
                        {{ frame.name }}
                    </option>
                </select>
            </div>

            <div class="content__group">
                <label class="content__label" for="prism">Prisma</label>
                <select class="content__select" id="prism" v-model="prism">
                    <option value="">Selecciona</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="content__group">
                <label class="content__label" for="pupillary_distance">Distancia Pupilar</label>
                <input class="content__input" type="number" id="pupillary_distance" v-model="pupillary_distance">
            </div>

            <div class="content__group">
                <label class="content__label" for="lens_value">Valor Lente</label>
                <input class="content__input" type="number" id="lens_value" v-model="lens_value">
            </div>

            <div class="content__group">
                <label class="content__label" for="deliver_date">Fecha de Entrega</label>
                <input type="date" class="content__input" id="deliver_date" v-model="deliver_date">
            </div>

            <div class="content__group">
                <label class="content__label" for="retirement_date">Fecha de Retiro</label>
                <input type="date" class="content__input" id="retirement_date" v-model="retirement_date">
            </div>

            <div class="content__group">
                <label class="content__label" for="observation">Observación</label>
                <textarea class="content__input input-textarea" id="observation" v-model="observation"></textarea>
            </div><p>

            <div class="content__group">
                <label class="content__label" for="rut_doctor">Rut Medico</label>
                <input type="text" class="content__input" id="rut_doctor" v-model="rut_doctor">
            </div>

            <div class="content__group">
                <label class="content__label" for="name_doctor">Nombre Medico</label>
                <input type="text" class="content__input" id="name_doctor" v-model="name_doctor">
            </div>

            <div class="content__function">
                <button class="content__button" v-on:click="createRecipe">Registrar Receta</button>
            </div>

            <div class="content__result">
                <p class="content__message" v-html="message"
                    v-bind:class="{'message-success': message == 'La Receta Se Registro'}">
                </p>
            </div>
        </form>
    `),
    data: function() {
        return {
            rut_client: "", lens_type: [], sphere_left: "", cylinder_left: "",
            axis_left: "", sphere_right: "", cylinder_right: "", axis_right: "",
            crystal_types: "", crystal_materials: "", frames: "", retirement_date: "",
            prism: "", pupillary_distance: "", lens_value: "", deliver_date: "",
            observation: "", rut_doctor: "", name_doctor: "", message: "",
            rut: "", name: "", email: "", type: "", material: "", frame: "",
            doctor_visit_date: "", base: ""
        }
    },
    mounted: async function() {
        try {
            const types = await fetch(
                "https://opticsapp.herokuapp.com/controller/ViewCrystalType.php"
            );

            const materials = await fetch(
                "https://opticsapp.herokuapp.com/controller/ViewCrystalMaterial.php"
            );

            const frames = await fetch(
                "https://opticsapp.herokuapp.com/controller/ViewFrame.php"
            );

            if(types.ok && materials.ok && frames.ok) {
                const type = await types.json();
                const material = await materials.json();
                const frame = await frames.json();
                
                if(type == "" && material == "" && frame == "") {
                    console.log("No Data Was Obtained");
                } else {
                    this.crystal_materials = material;
                    this.crystal_types = type;
                    this.frames = frame;
                }
            } else {
                console.log("No Server Response");
            }
        } catch (exception) {
            console.log("NewRecipeException: " + exception);
        }
    },
    methods: {
        createRecipe: async function(event) {
            event.preventDefault();
            
            var form = new FormData();
            form.append("lens_type", this.lens_type);
            form.append("crystal_type", this.type);
            form.append("crystal_material", this.material);
            form.append("sphere_left", this.sphere_left);
            form.append("sphere_right", this.sphere_right);
            form.append("cylinder_left", this.cylinder_left);
            form.append("cylinder_right", this.cylinder_right);
            form.append("axis_left", this.axis_left);
            form.append("axis_right", this.axis_right);          
            form.append("base", this.base);
            form.append("frame", this.frame);
            form.append("prism", this.prism);
            form.append("pupillary_distance", this.pupillary_distance);
            form.append("lens_value", this.lens_value);
            form.append("deliver_date", this.deliver_date);
            form.append("retirement_date", this.retirement_date);
            form.append("observation", this.observation);
            form.append("rut_client", this.rut);
            form.append("rut_doctor", this.rut_doctor);
            form.append("name_doctor", this.name_doctor);
            console.log("Form: " + form.get());
            
            try {
                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/NewRecipe.php",
                    { method: "post", body: form }
                );
    
                if(response.ok) {
                    const received = await response.json();
    
                    if(received == "La Receta Se Registro") {
                        this.lens_type = "", this.type = "";
                        this.material = "", this.sphere_left = "";
                        this.sphere_right = "", this.cylinder_left = "";
                        this.cylinder_right = "", this.axis_left = "";
                        this.axis_right = "", this.base = "";
                        this.frame = "", this.prism = "", this.rut_client = "";
                        this.pupillary_distance = "", this.lens_value = "";
                        this.deliver_date = "", this.retirement_date = "";
                        this.observation = "", this.rut = "";        
                        this.rut_doctor = "", this.name_doctor = "";
                        this.email = "", this.name = "";
                        this.message = received;

                    } else {
                        this.message = received;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("NewRecipeException: " + exception);
            }
        },
        searchClient: async function() {
            var form = new FormData();
            form.append("rut", this.rut_client);
            
            try {
                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/SearchClient.php",
                    { method: "post", body: form }
                );
    
                if(response.ok) {
                    const received = await response.json();
                    
                    if(received == "" || this.rut_client == "") {
                        this.email = "", this.rut = "";
                        this.name = "";
                    } else {
                        this.rut = received[0].rut;
                        this.email = received[0].email;
                        this.name = received[0].name;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("NewRecipeException: " + exception);
            }
        }
    }
});