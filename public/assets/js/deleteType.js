var deletebtn = document.querySelectorAll('.btnToDeleteType');
var deletecontainer = document.getElementById('my-deleteTypecontainer');
var deletecancelar = document.getElementById('my-deleteTypebtn-cancelar');
var deleteaceptar = document.getElementById('my-deleteTypebtn-aceptar');
var deleteText = document.getElementById('deleteType');
var deleteTextPokemon = document.getElementById('deleteTypePokemon');
var url;

for(let i = 0; i < deletebtn.length; i++) {
    deletebtn[i].addEventListener('click', function() {
        var name = deletebtn[i].dataset.name; 
        url = deletebtn[i].dataset.url;
        deleteText.textContent = name;
        deleteTextPokemon.textContent = name;
        deletecontainer.style.display = 'flex';
    });
}

deletecancelar.addEventListener('click', function() {
    deletecontainer.style.display = 'none';
});

deleteaceptar.addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('modalDeleteTypeForm').action = url;
    document.getElementById('modalDeleteTypeForm').submit();
});