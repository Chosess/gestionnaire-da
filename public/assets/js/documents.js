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
        } else{
            valeurs.push(document.id)
        }
        input.value = valeurs.join();
        console.log(input.value);
    })
});


// documents.forEach(document => {
//     document.addEventListener('click', function(){
//         input.value = input.value + document.id;
//     })
// });

// for(let x = 0; x < input.options.length; x++){
//     documents[x].addEventListener('click', function(){
//         if(input.options[x].selected == false){
//             input.options[x].selected = true;
//         } else {
//             input.options[x].selected = false;
//         }
//         console.log(input.options[x].selected);
//     })
// }