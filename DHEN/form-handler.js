document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    const formContainer = document.getElementById('form-container');
    const formMessage = document.getElementById('form-message');

    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(contactForm);

            fetch('send_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    formContainer.classList.add('hidden');
                    formMessage.classList.remove('hidden');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons(); // Re-render success icon if lucide is available
                    }
                } else {
                    alert('There was a problem sending your message. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was a problem sending your message. Please try again.');
            });
        });
    }
});