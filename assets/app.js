import './bootstrap';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
console.log('app.js correctement importé')

// Script pour gérer l'ouverture et la fermeture de la modale de login
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('loginModal');
    const btn = document.getElementById('loginBtn');
    const closeBtn = document.getElementsByClassName('close')[0];

    btn.onclick = function() {
        modal.classList.remove('hidden');
        console.log('click on modal')
    }

    closeBtn.onclick = function() {
        modal.classList.add('hidden');
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    }
});
