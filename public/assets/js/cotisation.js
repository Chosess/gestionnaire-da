// on n'affiche les champs payée le / moyen de paiement / Montant
// on récupère les champs dont on a besoin
let cotisationOui = document.querySelector('#eleves_form_cotisations');
let cotisationNon = cotisationOui.nextElementSibling.nextElementSibling;
let cotisationDate = cotisationOui.parentElement.nextElementSibling;
let cotisationMoyen = cotisationDate.nextElementSibling;
let cotisationMontant = cotisationMoyen.nextElementSibling;
let cotisationDisplay = cotisationOui.style.display;

if(cotisationOui.checked == false){
    cotisationDate.style.display = 'none';
    cotisationMoyen.style.display = 'none';
    cotisationMontant.style.display = 'none';
}

cotisationOui.addEventListener('click', function(){
    if(cotisationOui.checked == false){
        cotisationDate.style.display = 'none';
        cotisationMoyen.style.display = 'none';
        cotisationMontant.style.display = 'none';
    } else {
        cotisationDate.style.display = cotisationDisplay;
        cotisationMoyen.style.display = cotisationDisplay;
        cotisationMontant.style.display = cotisationDisplay;
    }
})

cotisationNon.addEventListener('click', function(){
    if(cotisationOui.checked == false){
        cotisationDate.style.display = 'none';
        cotisationMoyen.style.display = 'none';
        cotisationMontant.style.display = 'none';
    } else {
        cotisationDate.style.display = cotisationDisplay;
        cotisationMoyen.style.display = cotisationDisplay;
        cotisationMontant.style.display = cotisationDisplay;
    }
})