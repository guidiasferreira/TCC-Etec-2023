const iconButton = document.querySelector(".searchBoxIcon");
const searchInput = document.querySelector(".searchInput");
var sec = 500;

let numCliques = 0;

iconButton.addEventListener("click", function () {
  numCliques++;
  if (numCliques === 1) {
    // Primeiro clique
    searchInput.classList.toggle("displayBlock");
    iconButton.classList.toggle("borderRadius");
  } else {
    // Segundo clique

    
    searchInput.classList.toggle("displayBlock");

    setTimeout(function(){ iconButton.classList.toggle("borderRadius"); }, sec );


    numCliques = 0; // Reseta a contagem para recomeçar do primeiro clique
  }
});