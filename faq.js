// Get references to the button and vertical navbar
const navToggle = document.getElementById('navToggle');
const verticalNavbar = document.getElementById('verticalNavbar');

// Add a click event listener to the button
navToggle.addEventListener('click', () => {
    // Toggle the visibility of the vertical navbar
    if (verticalNavbar.style.display === 'block') {
        verticalNavbar.style.display = 'none';
    } else {
        verticalNavbar.style.display = 'block';
    }
});