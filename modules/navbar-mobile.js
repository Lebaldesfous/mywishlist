document.addEventListener('DOMContentLoaded', () => {

    const navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  
    // If the user is on a mobile screen
    if (navbarBurgers.length > 0) {
  
        navbarBurgers.forEach(elem => {
            elem.addEventListener('click', () => {
    
                const target = elem.dataset.target;
                const targetElement = document.getElementById(target);
        
                elem.classList.toggle('is-active');
                targetElement.classList.toggle('is-active');
            });
        });
    }
  
});