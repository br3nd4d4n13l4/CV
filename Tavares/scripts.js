document.addEventListener('DOMContentLoaded', function(){
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown =>{
        const menuLink = dropdown.querySelector('.menu-link');
        const submenu = dropdown.querySelector('.submenu');

        menuLink.addEventListener('click', function(event){
            event.preventDefault();
            submenu.classList.toggle('show');
        });
    });
    document.addEventListener('click', function(event){
        if(!event.target.closest('.dropdown')){
            dropdowns.forEach(dropdown => {
                const submenu = dropdown.querySelector('.submenu');
                submenu.classList.remove('show');
            });
        }
    });
});