// on va mettre le champ incomplet en display none si la valeur du champ complet est oui

// on récupère les éléments dont on a besoin
// le champ incomplet et la div parente du champ incomplet
let incomplet = document.querySelector('#eleves_form_incomplet');
let div = incomplet.parentElement;

// les champs oui et non
let oui = document.querySelector('#eleves_form_complet');
let non = oui.nextElementSibling.nextElementSibling;

// on récupère le display initial de la div parente du champ incomplet
let display = div.style.display;

oui.addEventListener('click', function(){
    if(oui.checked == true){
        div.style.display = 'none';
    } else {
        div.style.display = display;
    }
})

non.addEventListener('click', function(){
    if(non.checked == false){
        div.style.display = 'none';
    } else {
        div.style.display = display;
    }
})