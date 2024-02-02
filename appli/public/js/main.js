
// ++++++++++++++++NAV+++++++++++++++++++++++++++++++++++++

// document.querySelector('.menu-icon').addEventListener('click', function () {
//     document.querySelector('nav ul').classList.toggle('show');
// });

// ++++++++++++++++++ACCUEIL++++++++++++++++++++++++++++++++++++


document.addEventListener('DOMContentLoaded', function () {
    const dots = document.querySelectorAll('.scrolling-dot');
    const wrapper = document.querySelector('.scrolling-wrapper');

    let currentIndex = 0;

    setInterval(() => {
        // Réinitialiser tous les indicateurs
        dots.forEach(dot => dot.classList.remove('active'));

        // Mettre à jour l'indicateur actif
        dots[currentIndex % dots.length].classList.add('active');

        currentIndex++;
    }, 8000);

    // Pause l'animation lorsqu'on survole la zone de défilement
    wrapper.addEventListener('mouseover', () => {
        const cards = document.querySelectorAll('.scrolling-card');
        cards.forEach(card => card.style.animationPlayState = 'paused');
    });

    // Reprise de l'animation lorsqu'on quitte la zone de défilement
    wrapper.addEventListener('mouseout', () => {
        const cards = document.querySelectorAll('.scrolling-card');
        cards.forEach(card => card.style.animationPlayState = 'running');
    });
});


// ++++++++++++++FILMS++++++++++++++++++++++++++++++++++++
// LIST FILMS
function scrollFilms(direction) {
    const filmContainer = document.querySelector('.filmContainer');
    const scrollAmount = 500;
    
    if (direction === 'left') {
        filmContainer.scrollLeft -= scrollAmount;
        console.log('ok')
    } else if (direction === 'right') {
        filmContainer.scrollLeft += scrollAmount;
        console.log('ok')
    }
}