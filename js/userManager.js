import viewUser from "./module/viewUser.js";
import newUser from "./module/newUser.js";
import editUser from "./module/editUser.js";

var content = document.getElementById("content");

loadViewUser();

function loadViewUser() {
    content.innerHTML = viewUser.form;
    viewUser.loadUser();
    loadFunction();
}

function loadNewUser() {
    content.innerHTML = newUser.form;
    window.inputs = newUser.inputs;
    newUser.loadStates();
    newUser.create();
}

document.getElementById("viewUser").addEventListener("click", function() {
    loadViewUser();
});

document.getElementById("newUser").addEventListener("click", function() {
    loadNewUser();
});

function loadFunction() {
    setTimeout(() => {
        var userUpdate = document.getElementsByClassName("userUpdate");

        for(var i = 0; i < userUpdate.length; i++){
            userUpdate[i].addEventListener("click",function(){
                content.innerHTML = editUser.form;
                window.inputs = editUser.inputs;
                editUser.loadStates();
                editUser.update();

                var request = new XMLHttpRequest();
                request.open("post", "controller/SearchUser.php", true);
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.responseType = "json";
                request.onreadystatechange = function() {
                    if(request.response != null) {
                        document.getElementById("rut").value = request.response[0]["rut"];
                        document.getElementById("name").value = request.response[0]["name"];
                        document.getElementById("state").value = request.response[0]["state"];
                    }
                };
                request.send("rut=" + this.parentElement.getAttribute("id") + "");
            });
        }
    }, 1000)
}