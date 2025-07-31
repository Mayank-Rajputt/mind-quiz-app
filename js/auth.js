/**
 * AJAX Authentication Logic
 *
 * This script handles login and registration forms using the Fetch API
 * to provide a smooth, single-page-app-like experience without page reloads.
 */
document.addEventListener('DOMContentLoaded', () => {

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    if (loginForm) {
        loginForm.addEventListener('submit', handleAuthForm);
    }

    if (registerForm) {
        registerForm.addEventListener('submit', handleAuthForm);
    }

});

/**
 * Handles the submission for both login and registration forms.
 * @param {Event} e The form submission event.
 */
async function handleAuthForm(e) {
    e.preventDefault(); // Prevent the default page reload

    const form = e.target;
    const endpoint = form.dataset.endpoint; // Get the API endpoint from a data attribute
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    // Disable button and show a loading state
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="spinner"></span> Loading...';

    // Clear previous errors
    clearErrors(form);

    // Create a data object from the form fields
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            // On success, show a success message and redirect
            displayGeneralMessage(form, result.message, 'success');
            // Redirect to the dashboard after a short delay
            setTimeout(() => {
                window.location.href = 'dashboard.php';
            }, 1500);
        } else {
            // On failure, display errors
            displayGeneralMessage(form, result.message, 'error');
            if (result.errors) {
                displayFieldErrors(form, result.errors);
            }
            // Re-enable the button
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        }

    } catch (error) {
        console.error('Authentication error:', error);
        displayGeneralMessage(form, 'A network error occurred. Please try again.', 'error');
        // Re-enable the button
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    }
}

/**
 * Displays errors for specific form fields.
 * @param {HTMLFormElement} form The form element.
 * @param {object} errors An object containing field names and error messages.
 */
function displayFieldErrors(form, errors) {
    for (const fieldName in errors) {
        const input = form.querySelector(`[name="${fieldName}"]`);
        if (input) {
            const errorContainer = input.nextElementSibling; // Assumes error div is next sibling
            if (errorContainer && errorContainer.classList.contains('error-text')) {
                errorContainer.textContent = errors[fieldName];
            }
        }
    }
}

/**
 * Displays a general message (like success or a general error) at the top of the form.
 * @param {HTMLFormElement} form The form element.
 * @param {string} message The message to display.
 * @param {string} type The type of message ('success' or 'error').
 */
function displayGeneralMessage(form, message, type) {
    // Remove any existing message
    const existingMessage = form.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }

    if (message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.textContent = message;
        form.prepend(messageDiv);
    }
}

/**
 * Clears all previous error messages from the form.
 * @param {HTMLFormElement} form The form element.
 */
function clearErrors(form) {
    // Clear general message
    const existingMessage = form.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }
    // Clear field-specific errors
    const errorTexts = form.querySelectorAll('.error-text');
    errorTexts.forEach(el => el.textContent = '');
}

// Add a simple spinner style to the head for the loading button
const style = document.createElement('style');
style.innerHTML = `
.spinner {
    display: inline-block;
    width: 1em;
    height: 1em;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 1s ease-in-out infinite;
    margin-right: 0.5em;
    vertical-align: middle;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
`;
document.head.appendChild(style);
