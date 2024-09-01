var countDownDate = new Date("May 27, 2026 12:00:00").getTime();
var h2 = document.getElementById("jelentkezz");

var x = setInterval(function() {
    var now = new Date().getTime();

    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('day').innerHTML = days;
    document.getElementById('hour').innerHTML = hours;
    document.getElementById('minute').innerHTML = minutes;
    document.getElementById('second').innerHTML = seconds;

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "A konferencia elkezdődött! Sok sikert kívánunk minden egyes résztvevőnek!";
        document.getElementById("countdown").style.color = "white";
        document.getElementById("countdown").style.fontSize = "xx-large";
        document.getElementById("countdown").style.background = "#72358C";
        
        document.getElementById("day").remove();
        document.getElementById("hour").remove();
        document.getElementById("minute").remove();
        document.getElementById("second").remove();
        document.getElementById("jelentkezz").remove();
        document.getElementById("btns").remove();
    }
}, 1000);