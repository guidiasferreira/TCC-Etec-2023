
// const red = document.querySelector(".red");
// const green = document.querySelector(".green");


const agendarButton = document.querySelector("#agendarButton");
const voltarButton = document.querySelector("#voltarButton");
const divAgendamento = document.querySelector("#agendamento");
const divInformacoes = document.querySelector("#informacoes");
voltarButton.type = 'button';


agendarButton.addEventListener('click', () => {
    divAgendamento.classList.add("display-flex");
    divAgendamento.classList.remove("display-none");
    divInformacoes.classList.remove("display-flex");
    divInformacoes.classList.add("display-none");
})
voltarButton.addEventListener('click',()=>{
    divInformacoes.classList.add("display-flex");
    divInformacoes.classList.remove("display-none");
    divAgendamento.classList.add("display-none");
    divAgendamento.classList.remove("display-flex");
})
