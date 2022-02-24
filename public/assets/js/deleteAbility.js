var deletebtn = document.querySelectorAll('.btnToDeleteAbility');
var deletecontainer = document.getElementById('my-deleteAbilitycontainer');
var deletecancelar = document.getElementById('my-deleteAbilitybtn-cancelar');
var deleteaceptar = document.getElementById('my-deleteAbilitybtn-aceptar');
var deleteText = document.getElementById('deleteAbility');
var deleteTextPokemon = document.getElementById('deleteAbilityPokemon');
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
    document.getElementById('modalDeleteAbilityForm').action = url;
    document.getElementById('modalDeleteAbilityForm').submit();
});

var indexabilityinner = document.querySelectorAll(".showability-pokemoncontainer");
for(let i = 0; i < indexabilityinner.length; i++) {
    indexabilityinner[i].addEventListener('mouseover', function() {
        indexabilityinner[i].style.transform = 'translateY(-5px)';
    })
    
    indexabilityinner[i].addEventListener('mouseout', function() {
        indexabilityinner[i].style.transform = 'translateY(0)';
    })
}