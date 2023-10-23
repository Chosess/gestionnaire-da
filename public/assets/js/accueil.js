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