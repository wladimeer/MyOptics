Vue.component("view-recipe", {
    template: (`
        <form class="content__form">
            <div class="content__group">
                <label class="content__label" for="rut">Rut</label>
                <input type="text" class="content__input" v-on:keyup="searchRecipe('rut')" id="rut" v-model="rut">
            </div>

            <div class="content__group">
                <label class="content__label" for="date">Fecha</label>
                <input type="date" class="content__input" v-on:change="searchRecipe('date')" id="date" v-model="date">
            </div>

            <table class="content__table" border="1">
                <thead>
                    <tr>
                        <th class="content__th">Tipo de Lente</th>
                        <th class="content__th">Fecha de Entrega</th>
                        <th class="content__th" colspan="2">Funciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="content__tr" v-if="recipes != ''"  v-for="recipe in recipes">
                        <td class="content__td" data-label="Tipo de Lente:">{{ recipe.lens_type }}</td>
                        <td class="content__td" data-label="Fecha de Entrega:">{{ recipe.deliver_date }}</td>
                        <td class="content__td content__a" v-on:click="check(recipe.id)">Revisar</td>
                        <td class="content__td content__a" v-on:click="detail(recipe.id)">Exportar</td>
                    </tr>

                    <tr class="content__tr" v-if="recipes == ''">
                        <td class="content__td" data-label="Resultado:" colspan="4">Sin Resultados</td>
                    </tr>
                </tbody>
            </table>

            <div class="modal" v-if="modal" v-on:click="uncheck">
                <div class="content-modal">
                    <h1 class="modal__h1">Detalles de la Receta</h1><hr>

                    <table class="content__table" border="1">
                        <thead>
                            <tr>
                                <th class="content__th">Cliente</th>
                                <th class="content__th">Fecha de Entrega</th>
                                <th class="content__th">Fecha de Retiro</th>
                                <th class="content__th">Valor Lente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="content__tr" v-if="recipes != ''"  v-for="recipe in recipe">
                                <td class="content__td" data-label="Cliente:">{{ recipe.name_client }}</td>
                                <td class="content__td" data-label="Fecha de Entrega:">{{ recipe.deliver_date }}</td>
                                <td class="content__td" data-label="Fecha de Retiro:">{{ recipe.retirement_date }}</td>
                                <td class="content__td" data-label="Valor Lente:">` + "$" + `{{ recipe.lens_value }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    `),
    data: function() {
        return {
            lens_type: "", deliver_date: "", rut: "",
            date: "", recipes: "", recipe: "", modal: false
        }
    },
    methods: {
        check: async function(identifier) {
            var form = new FormData();
            form.append("id", identifier);

            try {
                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/ViewRecipe.php",
                    { method: "post", body: form }
                );
    
                if(response.ok) {
                    const received = await response.json();
                    this.recipe = received;
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("ViewRecipeException: " + exception);
            }

            this.modal = true;
        },
        uncheck: function() {
            this.modal = false;
        },
        detail: function(identifier) {
            window.open(
                "https://opticsapp.herokuapp.com/controller/NewReport.php?id=" + identifier + "_blank"
            );
        },
        searchRecipe: async function(operation) {
            var form = new FormData();

            if(operation == "rut") {
                if(this.rut == "") {
                    this.recipes = "";
                } else {
                    form.append("rut", this.rut);
                    this.date = "";
                }
            } else {
                if(this.date == "") {
                    this.recipes = "";
                } else {
                    form.append("date", this.date);
                    this.rut = "";
                }
            }
            
            try {
                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/ViewRecipe.php",
                    { method: "post", body: form }
                );
    
                if(response.ok) {
                    const received = await response.json();
                    this.recipes = received;
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("ViewRecipeException: " + exception);
            }
        }
    }
});