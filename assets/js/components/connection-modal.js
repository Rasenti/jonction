export function initModal() {
    const modal = document.getElementById('loginModal');
    const btn = document.getElementById('loginBtn');
    const closeBtn = document.getElementsByClassName('close')[0];
    const backdrop = document.getElementById('modalBackdrop');

    // Open modal on click on connection
    btn.onclick = function() {
        modal.classList.remove('hidden');
    }

    // Close modal on click on close button
    closeBtn.onclick = function() {
        modal.classList.add('hidden');
    }

    // Close modal on click outside of it
    backdrop.onclick = function() {
        modal.classList.add('hidden');
    }
}