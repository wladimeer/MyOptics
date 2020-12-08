const store = new Vuex.Store({
    state: {
        currentPage: "newClient",
    },
    mutations: {
        newClient: function(state) {
            state.currentPage = "newClient";
        },
        viewRecipe: function(state) {
            state.currentPage = "viewRecipe";
        },
        newRecipe: function(state) {
            state.currentPage = "newRecipe";
        }
    }
});

new Vue({ 
    el: "#app",
    store: store,
    components: {
        newClient: { template: "<new-client></new-client>" },
        viewRecipe: { template: "<view-recipe></view-recipe>" },
        newRecipe: { template: "<new-recipe></new-recipe>" }
    },
    methods: {
        ...Vuex.mapMutations(["newClient", "viewRecipe", "newRecipe"])
    }
});