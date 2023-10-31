// on affiche le champ date d'inscription que si l'inscription est validée
// on récupère les champs dont on a besoin
let validationInscriptionOui = document.querySelector('#eleves_form_validation_inscription');
let validationInscriptionNON = validationInscriptionOui.nextElementSibling.nextElementSibling;
let dateInscription = document.querySelector('#eleves_form_date_inscription').parentElement;
let displayDateInscription = dateInscription.style.display;

if(validationInscriptionOui.checked == false){
    dateInscription.style.display = 'none';
} 

validationInscriptionOui.addEventListener('click', function(){
    if(validationInscriptionOui.checked == true){
        dateInscription.style.display = displayDateInscription;
    } else {
        dateInscription.style.display = 'none';
    }
})

validationInscriptionNON.addEventListener('click', function(){
    if(validationInscriptionNON.checked == false){
        dateInscription.style.display = displayDateInscription;
    } else {
        dateInscription.style.display = 'none';
    }
})