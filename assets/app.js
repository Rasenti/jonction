import './bootstrap';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import {initModal} from "./js/components/connection-modal";
import {initBackToTopButton} from "./js/components/back-to-top-button";
console.log('app.js correctement importé')

// Login modal open/close script
document.addEventListener('DOMContentLoaded', (event) => {
    initModal();
    initBackToTopButton()
});
