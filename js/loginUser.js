var form = document.getElementById("form");

form.addEventListener("submit", function() {
    var result = document.getElementById("result");
    var inputs = new FormData(form);

    try {
        fetch("http://localhost/optics/controller/LoginUser.php", {
            method: "post",
            body: inputs
        })
        .then(response => response.json())
        .then(received => {
            result.innerHTML = received
            result.classList.add("result-active");
            result.style.color = "red";
        })
        .catch(() => {
            result.innerHTML = "Iniciando Sesión...";
            result.classList.add("result-active");
            result.style.color = "green"

            setTimeout(() => {    
                form.action = "controller/LoginUser.php";
                form.method = "post";
                form.submit();
            }, 2000);
        });
    } catch (exception) {
        console.log("Exception: " + exception);
    }

    event.preventDefault();
});