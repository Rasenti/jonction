import './bootstrap';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
console.log('app.js correctement importé')

// Login modal open/close script
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('loginModal');
    const btn = document.getElementById('loginBtn');
    const closeBtn = document.getElementsByClassName('close')[0];
    const backdrop = document.getElementById('modalBackdrop');

    // Open modal on click on connection
    btn.onclick = function() {
        modal.classList.remove('hidden');
        console.log('click on modal')
    }

    // Close modal on click on close button
    closeBtn.onclick = function() {
        modal.classList.add('hidden');
    }

    // Close modal on click outside of it
    backdrop.onclick = function() {
        modal.classList.add('hidden');
        console.log('Modal closed by clicking outside');
    }
});
