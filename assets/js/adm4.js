var divInput = document.querySelector(".divInput");
var registro = document.querySelector("#registro");
var label = document.querySelector("#label");
var btn = document.querySelector("#btn");

function verificarSelecao() {
    var registroOption = registro.options[registro.selectedIndex];
    var registroValue = registroOption.value;
    if (registroValue === "autor" || registroValue === "categoria" || registroValue === "editora") {
        
        divInput.classList.add("display-flex");
        divInput.classList.remove("display-none");
        registro.classList.add("display-none");
        label.classList.add("display-none");
        btn.classList.add("display-none");

        if (registroValue === "autor") {
            var input = document.querySelector("#input");
            input.placeholder = "Digite o nome do autor";
            var inputName = input.name;
            input.name = "autor";
            
            
        }
        if (registroValue === "categoria") {
            var input = document.querySelector("#input");
            input.placeholder = "Digite o nome da categoria";
            var inputName = input.name;
            input.name = "categoria";
        }
        if (registroValue === "editora") {
            var input = document.querySelector("#input");
            input.placeholder = "Digite o nome da editora";
            var inputName = input.name;
            input.name = "editora";
        }
    }
}
function voltar() {
    divInput.classList.remove("display-flex");
    divInput.classList.add("display-none");
    registro.classList.remove("display-none");
    label.classList.remove("display-none");
    btn.classList.remove("display-none");

    var input = document.querySelector("#input");
    var inputName = input.name;
    input.name = "";
}
var input = document.querySelector("#input");
input.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Impede o comportamento padrão (envio do formulário)
        var envio = document.querySelector("#envio");
        envio.click(); 
    }
});

