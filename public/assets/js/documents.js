// on récupère les documents
let documents = document.querySelectorAll('.document');

// on récupère l'input
let input = document.querySelector('#documents_form_remove');

// un tableau récupérant les id
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

// le bouton télécharger
let telecharger = document.querySelector('.telecharger');
// let doc = document.querySelector('.document');
// console.log(doc.children[0].src)
    
// le téléchargement des documents
telecharger.addEventListener('click', function(){
    valeurs.forEach(id => {
        let fichier = document.getElementById(id)
        
        let downloading = chrome.downloads.download({
            url: fichier.children[0].src,
            filename: fichier.children[1].textContent,
            conflictAction: "uniquify",
        });
        downloading.then(console.log('fin'))
    });
})