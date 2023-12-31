
// on sélectionne les inputs de type checkbox qui n'ont pas la classe transport
let checkboxs = document.querySelectorAll('input[type="checkbox"]:not(.transport)');

// on affiche / enlève les champs date de fin de suivi et motif si l'étudiant es toujours suivi à la mission locale
let suivi = document.querySelector('.jsnone');
let suividisplay = suivi.style.display;

if(suivi.previousElementSibling.children[1].checked == true){
    suivi.style.display = 'none';
}

checkboxs.forEach(checkbox => {
    // on rajoute le mot oui devant l'input
    checkbox.insertAdjacentHTML('beforebegin', '<span>Oui</span>');

    // on rajoute le mot non et un input derrière le premier input
    checkbox.insertAdjacentHTML('afterend', '<span>non</span><input type="checkbox" class="inputnon">');

    // on sélectionne l'input que l'on vient de créer
    let inputnon = checkbox.nextElementSibling.nextElementSibling;

    // si l'input oui n'est pas sélectionné, on sélectionne l'input non
    if(checkbox.checked == false){
        inputnon.checked = true
    }

    // on fait en sorte que lorsque l'on sélectionne le champ oui, le champ non se déselectionne et vice-versa
    checkbox.addEventListener('click', function(){
        if(checkbox.checked == true){
            checkbox.checked = true;
            inputnon.checked = false;
            checkbox.value = 1;
            if(suivi.previousElementSibling.children[4] === inputnon){
                suivi.style.display = 'none';
            }
        } else {
            checkbox.checked = false;
            inputnon.checked = true;
            checkbox.value = '';
            if(suivi.previousElementSibling.children[4] === inputnon){
                suivi.style.display = suividisplay;
            }
        }

    })

    inputnon.addEventListener('click', function(){
        if(inputnon.checked == true){
            inputnon.checked = true;
            checkbox.checked = false;
            checkbox.value = '';
            if(suivi.previousElementSibling.children[4] === inputnon){
                suivi.style.display = suividisplay;
            }
        } else {
            inputnon.checked = false;
            checkbox.checked = true;
            checkbox.value = 1;
            if(suivi.previousElementSibling.children[4] === inputnon){
                suivi.style.display = 'none';
            }
        }
    })
    
});
