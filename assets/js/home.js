/* Sistema de carrosel */

const swiper = new Swiper(".swiper", {
  cssMode: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});


// const swiper = new Swiper('.swiper', {
//   // Optional parameters
//   direction: 'horizontal',
//   loop: true,

//   // If we need pagination
//   pagination: {
//     el: '.swiper-pagination',
//   },

//   // Navigation arrows
//   navigation: {
//     nextEl: '.swiper-button-next',
//     prevEl: '.swiper-button-prev',
//   },

//   // And if we need scrollbar
//   scrollbar: {
//     el: '.swiper-scrollbar',
//   },

// });

/* Sistema de carrosel */



/* const iconButton = document.querySelector(".searchBoxIcon");
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
}); */





