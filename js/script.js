// Interactions JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire de contact
    const form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche l'envoi par défaut pour validation

            // Récupération des valeurs
            const nom = document.getElementById('nom').value.trim();
            const prenom = document.getElementById('prenom').value.trim();
            const email = document.getElementById('email').value.trim();
            const telephone = document.getElementById('telephone').value.trim();
            const sujet = document.getElementById('sujet').value;
            const message = document.getElementById('message').value.trim();

            // Validation
            let erreurs = [];

            if (nom === '') {
                erreurs.push('Le nom est requis.');
            }

            if (prenom === '') {
                erreurs.push('Le prénom est requis.');
            }

            if (email === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                erreurs.push('Un email valide est requis.');
            }

            if (telephone !== '' && !/^\d{10}$/.test(telephone.replace(/\s/g, ''))) {
                erreurs.push('Le téléphone doit contenir 10 chiffres.');
            }

            if (sujet === '') {
                erreurs.push('Veuillez choisir un sujet.');
            }

            if (message === '' || message.length < 10) {
                erreurs.push('Le message doit contenir au moins 10 caractères.');
            }

            // Affichage des erreurs ou envoi
            if (erreurs.length > 0) {
                alert('Erreurs :\n' + erreurs.join('\n'));
            } else {
                alert('Formulaire validé ! Envoi en cours...');
                form.submit(); // Envoi réel après validation
            }
        });
    }

    // Interaction dynamique : Menu responsive (exemple simple)
    const nav = document.querySelector('nav ul');
    if (nav) {
        const toggleButton = document.createElement('button');
        toggleButton.textContent = 'Menu';
        toggleButton.style.display = 'none'; // Masqué par défaut, visible sur mobile via CSS
        nav.parentElement.insertBefore(toggleButton, nav);

        toggleButton.addEventListener('click', function() {
            nav.classList.toggle('visible');
        });
    }
});