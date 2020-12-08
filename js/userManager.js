const store = new Vuex.Store({
    state: {
        currentPage: "viewUser",
        rut: "", name: "", state: ""
    },
    mutations: {
        viewUser: function(state) {
            state.currentPage = "viewUser";
        },
        newUser: function(state) {
            state.currentPage = "newUser";
        },
        editUser: async function(state, identifier) {
            try {
                var form = new FormData();
                form.append("rut", identifier);

                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/SearchUser.php",
                    { method: "post", body: form }
                );

                if(response.ok) {
                    const received = await response.json();

                    if(received == "") {
                        console.log("No Data Was Obtained");
                    } else {
                        state.rut = received[0].rut;
                        state.name = received[0].name;
                        state.state = received[0].state;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("UserManagerException: " + exception);
            }
            
            state.currentPage = "editUser";
        }
    },
    getters: {
        userData(state) {
            return [state.rut, state.name, state.state];
        }
    }
});

new Vue({ 
    el: "#app",
    store: store,
    components: {
        viewUser: { template: "<view-user></view-user>" },
        newUser: { template: "<new-user></new-user>" },
        editUser: { template: "<edit-user></edit-user>" }
    },
    methods: {
        ...Vuex.mapMutations(["viewUser", "newUser"])
    }
});