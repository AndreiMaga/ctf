var start_time = Math.round(new Date().getTime() / 1000);

var insert_css = "\
<style>\
    @import url('https://fonts.googleapis.com/css?family=Source%20Code%20Pro');\
    .timer {\
        font-family: 'Source Code Pro', sans-serif;\
        font-size: 56px;\
        text-align: center;\
        padding-top: 40px;\
        padding-bottom: 40px;\
    }\
</style>"

var clock_element = "\
<div class=\"timer\">\
    <p id=\"timer\">0</p>\
</div>\
"

function insert_timer() {
    var main = document.getElementById("main");
    main.innerHTML = clock_element + main.innerHTML;
    document.head.innerHTML += insert_css;
    document.getElementById("timer").style.color = start_time % 2 == 0 ? "#2169c1" : "#e02471";

}

function tick() {
    var timer = document.getElementById("timer");
    timer.innerHTML = Math.round(new Date().getTime() / 1000) - start_time;

    t = setTimeout(function() {
        tick()
    }, 1000)
}


insert_timer();
tick();