
var circle = document.querySelector('.progress svg circle:last-of-type');
var radius = circle.r.baseVal.value;
var circumference = 2 * Math.PI * radius;
var offset = circumference - (attendance_percentage / 100) * circumference;

circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = circumference;

function animateCircle() {
    circle.style.strokeDashoffset = offset;
}

animateCircle();

