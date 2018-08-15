// dodati event listener da bi imali datum zadnjeg kucanja u vidljivim poljima forma
/*window.onload = function() {
    document.getElementById('timestamp').setAttribute('value', new Date());
    console.log('fawsdf');
}
var button = document.getElementById('button');
button.addEventListener("mouseover", setTimeStamp); 

//var hiddenField = document.getElementById('timestamp');
//var button = document.getElementById('button');

function setTimeStamp() {
    document.getElementById('timestamp').setAttribute('value', new Date());
}
/*
//button.addEventListener('mouseover', setTimeStamp, false);
button.onmouseover = function() {
    document.getElementById('timestamp').setAttribute('value', new Date());
    console.log('asdfasdf');
}
*/

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('timestamp').setAttribute('value', new Date());
    console.log('fawsdf');
}, false);