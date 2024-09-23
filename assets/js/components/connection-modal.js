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

    document.addEventListener('DOMContentLoaded', function () {
        let loginModal = document.getElementById('loginModal');

        if (loginModal) {
            let form = loginModal.querySelector('form');

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Empêche la soumission normale du formulaire

                let formData = new FormData(form);
                let xhr = new XMLHttpRequest();
                xhr.open('POST', form.action, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Parse the response to extract the modal body content
                            let parser = new DOMParser();
                            let responseDoc = parser.parseFromString(xhr.responseText, 'text/html');
                            let newModalBody = responseDoc.querySelector('.modal-body').innerHTML;

                            // Replace the modal body content with the new content
                            let modalBody = form.querySelector('.modal-body');
                            modalBody.innerHTML = newModalBody;
                        } else {
                            // Handle errors
                            form.querySelector('.modal-body').innerHTML = '<div class="alert alert-danger">Une erreur s\'est produite. Veuillez réessayer plus tard.</div>';
                        }
                    }
                };

                xhr.send(formData);
            });
        }
    });

}