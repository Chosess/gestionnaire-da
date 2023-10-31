//on selectionne tous les jours
let jours = document.querySelectorAll('.jours');

// on récupère l'input de debut d'absence
let debut = document.querySelector('#absences_form_debut');

// on récupère l'input de fin d'absence
let fin = document.querySelector('#absences_form_fin');

// on initialise input
let input = 0;

// on ajoute un écouteur d'évènement sur l'input debut
debut.addEventListener('focus', function () {
    input = 'début';
})

// on ajoute un écouteur d'évènement sur l'input fin
fin.addEventListener('focus', function () {
    input = 'fin';
})


// on vas mettre en rouge les jours d'absences

// on récupère les absences
let absences = document.querySelectorAll('.absence');

// on crée un tableau pour récupérer toutes les absences
let tableauAbsences = [];
absences.forEach(absence => {
    tableauAbsences.push([absence.id.split('-')[0].split('/'), absence.id.split('-')[1].split('/'), absence.id.split('-')[2]]);
});

// on ajoute un écouteur d'évènement sur tous les jours avec une boucle
jours.forEach(jour => {
    jour.addEventListener('click', function () {
        //on vérifie si l'input du début est vide et qu'aucun input n'est sélectionné ou si l'input sélectionné est début
        if (debut.value == '' && input == 0 || input == 'début') {
            debut.value = jour.id;
            //on vérifie si l'input du début n'est pas vide et que l'input fin est vide et qu'aucun input n'est sélectionné ou si l'input sélectionné est fin
        } else if (debut.value != '' && fin.value == '' && input == 0 || input == 'fin') {
            fin.value = jour.id
        }
    })

    tableauAbsences.forEach(absence => {
        let j = jour.id.split('/');
        if (absence[0][2] <= j[2] && absence[1][2] >= j[2] && absence[0][1] <= j[1] && absence[1][1] >= j[1] && absence[0][0] <= j[0] && absence[1][0] >= j[0]) {
            if(absence[2] == 1){
            jour.style.backgroundColor = "rgba(255, 131, 0, 0.8)";
            } else {
                jour.style.backgroundColor = "rgba(255, 0, 0, 0.8)";
            }
            jour.style.border = "1px solid black";
        }
    });
});


// on récupère les inputs d'absences justifiées / non-justifiées
let justifie = document.querySelector('#absences_form_justif');
let nonjustifie = document.querySelector('.absencejustif');

justifie.addEventListener('click', function(){
    if(justifie.checked == false){
        justifie.checked = false;
        nonjustifie.checked = true;
    } else if(justifie.checked == true){
        justifie.checked = true;
        nonjustifie.checked = false;
    }
})

nonjustifie.addEventListener('click', function(){
    if(nonjustifie.checked == false){
        nonjustifie.checked = false;
        justifie.checked = true;
    } else if(nonjustifie.checked == true){
        nonjustifie.checked = true;
        justifie.checked = false;
    }
})