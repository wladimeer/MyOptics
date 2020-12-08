Vue.component("view-user", {
    template: (`
        <table class="content__table" border="1">
            <thead>
                <tr>
                    <th class="content__th">Rut</th>
                    <th class="content__th">Nombre</th>
                    <th class="content__th">Estado</th>
                    <th class="content__th">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr class="content__tr" v-if="users != ''"  v-for="user in users"
                    v-bind:id="user.rut" v-bind:class="{'tr_disabled': user.state == 0}"
                >
                    <td class="content__td" data-label="Rut:">{{ user.rut }}</td>
                    <td class="content__td" data-label="Nombre:">{{ user.name }}</td>
                    <td class="content__td" data-label="Estado:" v-if="user.state == 1">
                        Habilitado
                    </td>
                    <td class="content__td" data-label="Estado:" v-else>Deshabilitado</td>
                    <td class="content__td content__a" v-on:click="editUser(user.rut)">
                        Actualizar
                    </td>
                </tr>
                
                <tr class="content__tr" v-if="users == ''">
                    <td class="content__td" data-label="Resultado:" colspan="4">
                        No Se Encontraron Usuarios
                    </td>
                </tr>
            </tbody>
        </table>
    `),
    data: function() {
        return { users: "" }
    },
    methods: {
        ...Vuex.mapMutations(["editUser"])
    },
    mounted: async function() {
        try {
            const response = await fetch(
                "https://opticsapp.herokuapp.com/controller/ViewUser.php"
            );
            
            if(response.ok) {
                const received = await response.json();

                if(received == "") {
                    console.log("No Data Was Obtained");
                } else {
                    this.users = received;
                }
            } else {
                console.log("No Server Response");
            }
        } catch (exception) {
            console.log("ViewUserException: " + exception);
        }
    }
});