// on récupère l'input du formulaire
let inputform = document.querySelector('#eleves_form_removetransports');

let tableau = [];

// on ajoute un écouteur d'évènement sur les transports
let inputs = document.querySelectorAll('.transport');

inputs.forEach(input => {
    input.addEventListener('click', function () {
        if (input.checked == false) {
            let index = tableau.indexOf(input.id);
            if (index !== -1) {
                tableau.splice(index, 1);
            }
        } else if(input.checked == true) {
            tableau.push('' + input.id);
        }
        inputform.value = tableau.join();
    })
});


// on passe les champs modifiés et le bouton en rouge
let modifies = document.querySelectorAll('input');
let bouton = document.querySelector('button');

// on récupère le champ d'ajout de transport car on ne veut pas le mettre en rouge
let transport = document.querySelector('#eleves_form_newtransport');

let length = 0;
modifies.forEach(modifie => {
    // on récupère les valeurs initiales
    let valeur = modifie.value;
    let modifieborder = modifie.style.border;
    let boutonborder = bouton.style.border;

    // on ajoute un écouteur d'évènement sur les inputs
    modifie.addEventListener('input', function(){
        if(valeur != modifie.value && modifie != transport){
            modifie.style.border = '2px solid red';
            bouton.style.border = '2px solid red';
            length++;
        } else if(valeur == modifie.value && length == 1) {
            modifie.style.border = modifieborder;
            bouton.style.border = boutonborder;
            length--;
        } else {
            modifie.style.border = modifieborder;
            bouton.style.border = '2px solid red';
            length--;;
        }
    })
});         