// on récupère les documents
let documents = document.querySelectorAll('.document');

// on récupère l'input
let input = document.querySelector('#documents_form_remove');

let valeurs = [];

documents.forEach(document => {
    document.addEventListener('click', function(){
        if(valeurs.includes(document.id)){
            valeurs = valeurs.filter(function(element) {
                return element !== document.id;
            });
            document.style.border = '1px solid black';
        } else{
            valeurs.push(document.id)
            document.style.border = '2px solid blue';
        }
        input.value = valeurs.join();
    })
});