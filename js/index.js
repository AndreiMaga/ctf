var show_login = false;
var show_register = false;

function onShowLogin() {
    document.getElementById("login").style.display = "block";
    document.getElementById("show-login").className = "fas fa-angle-double-left fa-3x show-login";
    show_login = true;
}

function onHideLogin() {
    document.getElementById("login").style.display = "none";
    document.getElementById("show-login").className = "fas fa-angle-double-right fa-3x show-login";
    show_login = false;
}

function onShowRegister() {
    document.getElementById("register").style.display = "block";
    document.getElementById("show-register").className = "fas fa-angle-double-right fa-3x show-register";
    show_register = true;
}

function onHideRegister() {
    document.getElementById("register").style.display = "none";
    document.getElementById("show-register").className = "fas fa-angle-double-left fa-3x show-register";
    show_register = false;
}

function handleShowLogin() {
    show_login ? onHideLogin() : onShowLogin();
}

function handleShowRegister() {
    show_register ? onHideRegister() : onShowRegister();
}