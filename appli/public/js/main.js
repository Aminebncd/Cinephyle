
// ++++++++++++++++NAV+++++++++++++++++++++++++++++++++++++

// document.querySelector('.menu-icon').addEventListener('click', function () {
//     document.querySelector('nav ul').classList.toggle('show');
// });

// ++++++++++++++++++ACCUEIL++++++++++++++++++++++++++++++++++++


document.addEventListener('DOMContentLoaded', function () {
    const dots = document.querySelectorAll('.scrolling-dot');

    let currentIndex = 1;

    setInterval(() => {
        // Réinitialiser tous les indicateurs
        dots.forEach(dot => dot.classList.remove('active'));

        // Mettre à jour l'indicateur actif
        dots[currentIndex % dots.length].classList.add('active');

        currentIndex++;
    }, 1000);
});



// ++++++++++++++FILMS++++++++++++++++++++++++++++++++++++
// LIST FILMS
function scrollFilms(direction) {
    const filmContainer = document.querySelector('.filmContainer');
    const scrollAmount = 500; // Ajustez la quantité de défilement selon votre préférence
    
    if (direction === 'left') {
        filmContainer.scrollLeft -= scrollAmount;
        console.log('ok')
    } else if (direction === 'right') {
        filmContainer.scrollLeft += scrollAmount;
        console.log('ok')
    }
}