document.addEventListener('DOMContentLoaded', function() {
    // Seleziona tutte le sezioni
    const sections = document.querySelectorAll('.section');

    // Funzione per controllare se la sezione è visibile
    const checkVisibility = () => {
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= window.innerHeight - 100) {
                section.classList.add('visible');
            }
        });
    };

    // Controlla la visibilità iniziale
    checkVisibility();

    // Aggiunge un listener per lo scorrimento
    window.addEventListener('scroll', checkVisibility);

    // Funzione per espandere la barra
    const expandingBar = document.querySelector('.expanding-bar');
    const headerTitle = document.querySelector('.header h1');

    // Calcola la larghezza del titolo e aggiunge un margine extra
    const titleWidth = headerTitle.offsetWidth;
    const barWidth = titleWidth + 40; // Aggiunge 40px alla larghezza del titolo

    setTimeout(() => {
        expandingBar.style.width = `${barWidth}px`;
    }, 100); // Ritardo per vedere l'animazione dopo il caricamento della pagina
});
