
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

let upButton = document.getElementById('up-button');
let downButton = document.getElementById('down-button');
let imgOne = document.getElementById('item-img');

function changeImgOne() {
    imgOne.innerHTML = upButton.value;
}

function changeImgTwo() {
    imgOne.innerHTML = downButton.value;
}

upButton.addEventListener('click', changeImgOne);
downButton.addEventListener('click', changeImgTwo);