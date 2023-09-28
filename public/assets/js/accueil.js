// on ajoute un écouteur d'évènement sur les élèves
let eleves = document.querySelectorAll('section.navbar >ul >li');
eleves.forEach(eleve => {
    eleve.addEventListener('click', function () {
        // console.log(this.innerText)
        fetch('/api/data')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
    })
});

