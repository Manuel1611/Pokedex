var logoutbtn = document.getElementById('my-logoutbtn');
var logoutcontainer = document.getElementById('my-logoutcontainer');
var logoutcancelar = document.getElementById('my-logoutbtn-cancelar');
var logoutaceptar = document.getElementById('my-logoutbtn-aceptar');

logoutbtn.addEventListener('click', function() {
    logoutcontainer.style.display = 'flex';
});

logoutcancelar.addEventListener('click', function() {
    logoutcontainer.style.display = 'none';
});

logoutaceptar.addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
});