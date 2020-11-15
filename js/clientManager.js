import newClient from "./module/newClient.js";

var content = document.getElementById("content");

loadNewClient();

function loadNewClient() {
    content.innerHTML = newClient.form;
    newClient.create();
}

document.getElementById("newClient").addEventListener("click", function() {
    loadNewClient();
});

document.getElementById("searchRecipe").addEventListener("click", function() {
    
});

document.getElementById("newRecipe").addEventListener("click", function() {
    
});