// ++++++++++++++++NAV+++++++++++++++++++++++++++++++++++++

// document.querySelector('.menu-icon').addEventListener('click', function () {
//     document.querySelector('nav ul').classList.toggle('show');
// });

// ++++++++++++++++++ACCUEIL++++++++++++++++++++++++++++++++++++

// document.addEventListener("DOMContentLoaded", function () {
//   const dots = document.querySelectorAll(".scrolling-dot");
//   const wrapper = document.querySelector(".scrolling-wrapper");

//   let currentIndex = 0;

//   setInterval(() => {
//     // Réinitialiser tous les indicateurs
//     dots.forEach((dot) => dot.classList.remove("active"));

//     // Mettre à jour l'indicateur actif
//     dots[currentIndex % dots.length].classList.add("active");

//     currentIndex++;
//   }, 8000);

//   // Pause l'animation lorsqu'on survole la zone de défilement
//   wrapper.addEventListener("mouseover", () => {
//     const cards = document.querySelectorAll(".scrolling-card");
//     cards.forEach((card) => (card.style.animationPlayState = "paused"));
//   });

//   // Reprise de l'animation lorsqu'on quitte la zone de défilement
//   wrapper.addEventListener("mouseout", () => {
//     const cards = document.querySelectorAll(".scrolling-card");
//     cards.forEach((card) => (card.style.animationPlayState = "running"));
//   });
// });

// ++++++++++++++FILMS++++++++++++++++++++++++++++++++++++
// LIST FILMS

function scrollFilmsDate(direction) {
  const filmContainerDate = document.querySelector(".Date");
  const scrollAmount = 1000;

  if (direction === "left") {
    filmContainerDate.scrollLeft -= scrollAmount;
    console.log("ok");
  } else if (direction === "right") {
    filmContainerDate.scrollLeft += scrollAmount;
    console.log("ok");
  }
}
function scrollFilmsNote(direction) {
  const filmContainerNote = document.querySelector(".Note");
  const scrollAmount = 1000;

  if (direction === "left") {
    filmContainerNote.scrollLeft -= scrollAmount;
    console.log("ok");
  } else if (direction === "right") {
    filmContainerNote.scrollLeft += scrollAmount;
    console.log("ok");
  }
}

function scrollActeurs(direction) {
  const acteursContainer = document.querySelector(".acteurContainer");
  const scrollAmount = 1000;

  if (direction === "left") {
    acteursContainer.scrollLeft -= scrollAmount;
    console.log("ok");
  } else if (direction === "right") {
    acteursContainer.scrollLeft += scrollAmount;
    console.log("ok");
  }
}
