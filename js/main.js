/**
 * Global JavaScript for the Online Quiz App
 *
 * This script handles sitewide functionality, including the theme switcher
 * and the dashboard logout confirmation modal.
 */

document.addEventListener('DOMContentLoaded', function () {

    // --- THEME SWITCHER LOGIC ---
    const themeSwitch = document.getElementById('checkbox');
    if (themeSwitch) {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            themeSwitch.checked = true;
        }
        themeSwitch.addEventListener('change', function (event) {
            if (event.target.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
            }
        });
    }

    // --- NEW: DASHBOARD LOGOUT MODAL LOGIC ---
    const logoutBtn = document.getElementById('dashboard-logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const cancelLogoutBtn = document.getElementById('modal-logout-cancel');

    if (logoutBtn && logoutModal && cancelLogoutBtn) {
        // When the main logout button is clicked...
        logoutBtn.addEventListener('click', function (e) {
            // ...prevent it from going to logout.php immediately.
            e.preventDefault();
            // ...and show the modal.
            logoutModal.classList.add('is-visible');
        });

        // When the "Cancel" button inside the modal is clicked...
        cancelLogoutBtn.addEventListener('click', function () {
            // ...hide the modal.
            logoutModal.classList.remove('is-visible');
        });
    }

});
