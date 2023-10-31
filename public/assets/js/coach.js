// on va mettre le champ coach non inscrit en display none si le champ coach n'est pas null

// on récupère les éléments dont on a besoin
let coach = document.querySelector('#eleves_form_educateurs_id');
let coachNonInscrit = document.querySelector('#eleves_form_educateur_non_inscrit');
let displayCoachNonInscrit = coachNonInscrit.parentElement.style.display;

if(coach.value != ''){
    coachNonInscrit.parentElement.style.display = 'none';
}

coach.addEventListener('click', function(){
    if(coach.value == ''){
        coachNonInscrit.parentElement.style.display = display;
    } else {
        coachNonInscrit.parentElement.style.display = 'none';
    }
})