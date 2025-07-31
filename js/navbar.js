/**
 * JavaScript for the Smart Navbar
 *
 * This script handles the functionality of the responsive mobile menu (hamburger button)
 * and updates the live stats in the navbar during a quiz.
 */
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const navbarLinks = document.querySelector('.navbar-links');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            // Toggle a class to show/hide the menu
            const isActive = mobileMenu.classList.toggle('is-active');
            mobileMenuBtn.classList.toggle('is-active', isActive);
        });
    }

    // Function to populate the mobile menu with links from the desktop navbar
    function populateMobileMenu() {
        if (!navbarLinks || !mobileMenu) return;

        // Clear existing mobile menu items
        mobileMenu.innerHTML = '';

        // Clone main navigation links from the desktop view
        const linksToClone = navbarLinks.querySelectorAll('.nav-item');
        
        linksToClone.forEach(link => {
            mobileMenu.appendChild(link.cloneNode(true));
        });
        
        // Add profile and logout links manually for consistency
        const profileLink = document.createElement('a');
        profileLink.href = 'profile.php';
        profileLink.textContent = 'My Profile';
        profileLink.classList.add('nav-item');
        mobileMenu.appendChild(profileLink);

        const logoutLink = document.createElement('a');
        logoutLink.href = 'logout.php';
        logoutLink.textContent = 'Logout';
        logoutLink.classList.add('nav-item');
        mobileMenu.appendChild(logoutLink);
    }
    
    // Add some styles for the active hamburger icon animation
    const style = document.createElement('style');
    style.innerHTML = `
        .mobile-menu.is-active {
            display: block;
        }
        .mobile-menu-btn.is-active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        .mobile-menu-btn.is-active span:nth-child(2) {
            opacity: 0;
        }
        .mobile-menu-btn.is-active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
    `;
    document.head.appendChild(style);

    // Only populate the menu if the desktop links exist (i.e., not on the quiz page)
    if (navbarLinks && navbarLinks.querySelector('.nav-item')) {
        populateMobileMenu();
    }
});

// This function will be called from quiz.js to update the navbar stats
function updateNavbarStats(score, currentQuestionIndex, totalQuestions) {
    const navbarScoreEl = document.getElementById('navbar-score');
    const navbarProgressEl = document.getElementById('navbar-progress');

    if (navbarScoreEl) {
        navbarScoreEl.textContent = score;
    }

    if (navbarProgressEl) {
        const progressPercentage = ((currentQuestionIndex + 1) / totalQuestions) * 100;
        navbarProgressEl.style.width = `${progressPercentage}%`;
    }
}
