document.addEventListener('DOMContentLoaded', function() {
    const menuImg = document.querySelector('.menu');
    const userCard = document.querySelector('card');

    menuImg.addEventListener('click', function() {
        menuImg.classList.toggle('rotate');
        userCard.classList.toggle('show');
    });

    document.addEventListener('click', function(event) {
        if (!userCard.contains(event.target) && !menuImg.contains(event.target)) {
            userCard.classList.remove('show');
            menuImg.classList.remove('rotate');
        }
    });
});
