export function initBackToTopButton() {
    const backToTopBtn = document.getElementById('backToTopBtn');

    // Show button when scrolling down
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopBtn.classList.remove('opacity-0', 'invisible');
            backToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            backToTopBtn.classList.remove('opacity-100', 'visible');
            backToTopBtn.classList.add('opacity-0', 'invisible');
        }
    });

    // Scroll back to top on button click
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}