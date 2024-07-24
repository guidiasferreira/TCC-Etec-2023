// icons sidebar

// const perfil = document.querySelector("#perfil");
// const home  = document.querySelector("#home");
// const categorias = document.querySelector("#categorias");

// perfil.addEventListener('click',()=>{
//     window.location.href = "../perfil/index.php";
// })
// home.addEventListener('click',()=>{
//     window.location.href = "../home/index.php";
// })
// categorias.addEventListener('click',()=>{
//     window.location.href = "https://www.github.com/";
// })


/* Sidebar */

const b = document.querySelector(".button");
const m = document.querySelector("main");
const s = document.querySelector(".sidebar");


b.addEventListener('click', () => {
    s.classList.toggle("b");
    s.classList.toggle("sidebar");
    m.classList.toggle("active");

})

/* Sidebar */