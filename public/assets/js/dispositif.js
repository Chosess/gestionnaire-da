// on affiche un champs de texte quand la valeur sélectionnée est Autre
let dispositif = document.querySelector('#eleves_form_dispositif_aide');
let champTexte = document.querySelector('#eleves_form_valeur_dispositif');

// on affiche les champs conseiller et lieu lorsque la valeur sélectionnée est Mission locale
let conseiller = document.querySelector('#eleves_form_conseiller');
let lieuMl = document.querySelector('#eleves_form_lieu_ml');

if(dispositif.value != 'Autre'){
    champTexte.parentElement.style.display = 'none';
}

if(dispositif.value != 'Mission locale'){
    conseiller.parentElement.style.display = 'none';
    lieuMl.parentElement.style.display = 'none';
}

dispositif.addEventListener('click', function(){
    if(dispositif.value == 'Autre'){
        champTexte.parentElement.style.display = 'block';
    } else {
        champTexte.parentElement.style.display = 'none';
    }

    if(dispositif.value == 'Mission locale'){
        conseiller.parentElement.style.display = 'block';
        lieuMl.parentElement.style.display = 'block';
    } else {
        conseiller.parentElement.style.display = 'none';
        lieuMl.parentElement.style.display = 'none';
    }
})
