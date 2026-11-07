const carousel = document.querySelector('[data-carousel]');
const controls = carousel.querySelector('[data-carousel-controls]');

if (controls) {
    const slides = [...carousel.querySelectorAll('[data-film-slide]')];
    const choices = [...controls.querySelectorAll('[data-slide-index]')];
    const status = controls.querySelector('[data-carousel-status]');
    let active = 0;

    function showSlide(index) {
        slides[active].hidden = true;
        choices[active].removeAttribute('aria-current');
        active = (index + slides.length) % slides.length;
        slides[active].hidden = false;
        choices[active].setAttribute('aria-current', 'true');
        status.textContent = (active + 1) + ' dari ' + slides.length + ': ' + choices[active].ariaLabel;
    }

    controls.querySelector('[data-previous]').addEventListener('click', () => showSlide(active - 1));
    controls.querySelector('[data-next]').addEventListener('click', () => showSlide(active + 1));
    for (const choice of choices) {
        choice.addEventListener('click', () => showSlide(Number(choice.dataset.slideIndex)));
    }

    controls.addEventListener('keydown', (event) => {
        const direction = { ArrowLeft: -1, ArrowRight: 1 }[event.key];
        if (direction) {
            event.preventDefault();
            showSlide(active + direction);
            choices[active].focus();
        }
    });

    controls.hidden = false;
}
