// dodati event listener da bi imali datum zadnjeg kucanja u vidljivim poljima forma
window.onload = function() {
    document.getElementById('timestamp').setAttribute('value', new Date());
}