new Vue({
    el: "#app",
    data: {
        rut: "", password: "", message: ""
    },
    methods: {
        login: async function(event) {
            event.preventDefault();

            var form = new FormData();
            form.append("rut", this.rut);
            form.append("password", this.password);

            try {
                const response = await fetch(
                    "https://opticsapp.herokuapp.com/controller/LoginUser.php", 
                    { method: "post", body: form }
                );

                if(response.ok) {
                    const received = await response.json();
                    
                    if(received.success != undefined) {
                        this.message = "Iniciando Sesión...";

                        setTimeout(() => {    
                            if(received.success == "Usuario") {
                                window.location.href = "clientManager.php";
                            } else {
                                window.location.href = "userManager.php";
                            }
                        }, 1200);
                    } else {
                        this.message = received.message;
                    }
                } else {
                    console.log("No Server Response");
                }
            } catch (exception) {
                console.log("LoginUserException: " + exception);
            }
        }
    }
});