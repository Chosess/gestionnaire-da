// on récupère les documents
let documents = document.querySelectorAll('.document');

// on récupère l'input
let input = document.querySelector('#documents_form_remove');

// un tableau récupérant les id
let valeurs = [];


documents.forEach(document => {
    document.addEventListener('click', function () {
        if (valeurs.includes(document.id)) {
            valeurs = valeurs.filter(function (element) {
                return element !== document.id;
            });
            document.style.border = '1px solid black';
        } else {
            valeurs.push(document.id)
            document.style.border = '3px solid blue';
        }
        input.value = valeurs.join();
    })
});

// le bouton télécharger
let telecharger = document.querySelector('.telecharger');

// le téléchargement des documents
telecharger.addEventListener('click', function () {
    let downloadLinks = [];
    valeurs.forEach(id => {
        let fichier = document.getElementById(id);
        let link = '/assets/uploads/file/' + fichier.classList[1];
        let name = fichier.classList[1].split('---')[1];
        downloadLinks.push({url: link, nom: name});
    });

    // Télécharger les documents sélectionnés
    downloadSelectedDocuments(downloadLinks);
})

function downloadSelectedDocuments(documentLinks) {
    // Créez des liens de téléchargement pour les documents sélectionnés
    documentLinks.forEach(link => {
        const a = document.createElement("a");
        a.href = link.url;
        a.download = link.nom;
        a.style.display = "none";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    })
}