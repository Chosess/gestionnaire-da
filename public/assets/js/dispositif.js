// on affiche un champs de texte quand la valeur sélectionnée est Autre
let dispositif = document.querySelector('#eleves_form_dispositif_aide');
let champTexte = document.querySelector('#eleves_form_valeur_dispositif');

if(dispositif.value != 'Autre'){
    champTexte.parentElement.style.display = 'none';
}

dispositif.addEventListener('click', function(){
    if(dispositif.value == 'Autre'){
        champTexte.parentElement.style.display = 'block';
    } else {
        champTexte.parentElement.style.display = 'none';
    }
})