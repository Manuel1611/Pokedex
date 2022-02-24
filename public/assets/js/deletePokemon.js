var deletebtn = document.querySelectorAll('.btnToDeletePokemon');
var deletecontainer = document.getElementById('my-deletePokemoncontainer');
var deletecancelar = document.getElementById('my-deletePokemonbtn-cancelar');
var deleteaceptar = document.getElementById('my-deletePokemonbtn-aceptar');
var deleteText = document.getElementById('deletePokemon');
var url;

for(let i = 0; i < deletebtn.length; i++) {
    deletebtn[i].addEventListener('click', function() {
        var name = deletebtn[i].dataset.name; 
        url = deletebtn[i].dataset.url;
        deleteText.textContent = name;
        deletecontainer.style.display = 'flex';
    });
}

deletecancelar.addEventListener('click', function() {
    deletecontainer.style.display = 'none';
});

deleteaceptar.addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('modalDeletePokemonForm').action = url;
    document.getElementById('modalDeletePokemonForm').submit();
});

var indexpokemoncontainers = document.querySelectorAll(".indexpokemon-imgcontainer");
var indexpokemoninners = document.querySelectorAll(".indexpokemon-inner");
for(let i = 0; i < indexpokemoncontainers.length; i++) {
    indexpokemoncontainers[i].addEventListener('mouseover', function() {
        indexpokemoninners[i].style.transform = 'translateY(-5px)';
    })
    
    indexpokemoncontainers[i].addEventListener('mouseout', function() {
        indexpokemoninners[i].style.transform = 'translateY(0)';
    })
}

let filtertype = document.getElementById('filtertype');
if(filtertype) {
    filtertype.addEventListener('change', function() {
        let formType = document.getElementById('formType');
        formType.submit();
    });    
}
