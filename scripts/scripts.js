var nav_bar_container = document.querySelector('.nav');
var hamburger_button = document.querySelector('.hamburger');

var counter = 0;
hamburger_button.addEventListener('click', function(){
    if(counter == 0){

        nav_bar_container.style['animation-name'] = 'slideDown';
        counter = 1;

    }else{

        nav_bar_container.style['animation-name'] = 'slideUp';
        counter = 0;

    }
});

var close = document.querySelector('.notif-close');
var notif_container = document.querySelector('.notif-container');
close.onclick = function () {
    notif_container.style.animation = "slideUp 1s both";
}