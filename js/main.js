
function menuActive() {
    let menu = document.getElementById('menu');
    let logoIco = document.getElementById('logo-ico');
    if (document.getElementById('menu').classList.contains('active')) {
        menu.classList.remove('active');
        logoIco.classList.remove('active');
    } else {
        menu.classList.add('active');
        logoIco.classList.add('active');
    }
}

let menuButton = document.getElementById('menu-button');
menuButton.addEventListener('click', menuActive);