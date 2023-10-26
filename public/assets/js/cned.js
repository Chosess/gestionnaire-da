// on affiche le champ date d'incription CNED que si l'inscription est validée
let validation = document.querySelector('#eleves_form_statut_cned');
// on récupère le style initial
let styledisplay = validation.parentElement.nextElementSibling.style.display;
if(validation.value != 'Inscription validée'){
    validation.parentElement.nextElementSibling.style.display = 'none';
}
// on ajoute un écouteur d'évènement sur la sélection du statut de l'inscription CNED
validation.addEventListener('click', function(){
    if(validation.value == 'Inscription validée'){
        validation.parentElement.nextElementSibling.style.display = styledisplay;
    } else {
        validation.parentElement.nextElementSibling.style.display = 'none';
    }
})