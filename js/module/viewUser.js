export default {
    form: (`
        <table class="content__table" border="1">
            <thead>
                <tr>
                    <th class="content__th">Rut</th>
                    <th class="content__th">Nombre</th>
                    <th class="content__th">Estado</th>
                    <th class="content__th">Acción</th>
                </tr>
            </thead>
            <tbody id="body"></tbody>
        </table>
    `),
    loadUser: function() {
        var body = document.getElementById("body");
        
        try {
            fetch("http://localhost/optics/controller/ViewUser.php")
            .then(response => response.json())
            .then(user => {
                user.forEach(item => {
                    var tr = document.createElement("tr");
                    var firstValue = document.createElement("td");
                    var secondValue = document.createElement("td");
                    var thirdValue = document.createElement("td");
                    var button = document.createElement("td");

                    tr.setAttribute("id", item.rut);
                    firstValue.innerHTML = item.rut;
                    secondValue.innerHTML = item.name;
                    if(item.state == 1) {
                        thirdValue.innerHTML = "Habilitado";
                        tr.style.color = "black";
                    } else {
                        thirdValue.innerHTML = "Desabilitado";
                        tr.style.color = "red";
                    }
                    button.innerHTML = "Actualizar";

                    firstValue.className = "content__td";
                    secondValue.className = "content__td";
                    thirdValue.className = "content__td";
                    button.className = (
                        "userUpdate " + 
                        "content__td " +
                        "content__a"
                    );

                    tr.appendChild(firstValue);
                    tr.appendChild(secondValue);
                    tr.appendChild(thirdValue);
                    tr.appendChild(button);
                    body.appendChild(tr);
                });
            })
            .catch(() => {
                var tr = document.createElement("tr");
                var empty = document.createElement("td");

                empty.innerHTML = "No se Encontraron Usuarios";
                empty.className = "content__td";
                empty.style.color = "black";
                empty.colSpan = "4";                

                tr.appendChild(empty);
                body.appendChild(tr);
            });
        } catch (exception) {
            console.log("Exception: " + exception);
        }

        // event.preventDefault();
    }
};