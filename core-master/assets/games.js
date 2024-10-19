const nameButton = document.getElementById('nameButton');

nameButton.addEventListener('click', () => {
    const getName = document.getElementById('playerName').value;
    if (getName.trim() ==='') {
        alert('Veuillez saisir un nom valide.');
        return;
    }else {
        const replayButton = document.querySelector('.replay-button');
        replayButton.style.display = 'none';
        document.querySelector(".player-info").style.display = 'none';
        const playerResult = document.querySelector(".player-result")
        playerResult.style.display = 'block';

        const start = Date.now();
        const play = document.querySelector(".play")
        play.style.display = 'block';
        const welcomeMessage = document.createElement('p');
        welcomeMessage.textContent = `Bienvenue ${getName} !`
        const set = document.createElement('p')
        set.textContent = 'Vous devez deviner un nombre entre 1 et 100. \n Vous avez  5 chances pour trouvez le bon nombre'
        play.appendChild(welcomeMessage);
        play.appendChild(set);

        const inputPlay = document.getElementById("choice")
        const setPlay = document.createElement('p')
        setPlay.textContent = 'Saisissez votre choix ci dessous et appuyez la touche entrée de votre clavier. \n'
        playerResult.insertBefore(setPlay, inputPlay)

        let nombreAleatoire = Math.round(Math.random() *100)
        console.log(nombreAleatoire)
        count = 5
        inputPlay.addEventListener('keydown', (event) => {
            if (event.key === "Enter") {
                const saisieJoueur= Number(inputPlay.value.trim())
                inputPlay.value = ''
                if (isNaN(saisieJoueur)) {
                    alert('Veuillez saisir un nombre valide.')
                    return;
                }
                count --
                const resultMessage = document.getElementById("resultGame")
                if (saisieJoueur === nombreAleatoire) {
                    const end = Date.now();
                    const time = end - start;
                    resultMessage.textContent = `Félicitations ${getName}! Vous avez trouvé le nombre en ${time} millisecondes après ${5-count} essais`;
                    resultMessage.style.color = "green";
                    play.style.display = 'none';
                    setPlay.textContent = '';
                    inputPlay.style.display = 'none';
                    return;
                }else if (saisieJoueur > nombreAleatoire ) {
                    resultMessage.textContent = `Votre choix est trop grand. Essayez encore. Par contre il vous reste ${count} possibilités`;
                    resultMessage.style.color = "red"
                }else{
                    resultMessage.textContent = `Votre choix est trop petit. Essayez encore. Par contre il vous reste ${count} possibilités`;
                    resultMessage.style.color = "red"
                }
                if (count === 0) {
                    const end = Date.now();
                    const time = end - start;
                    resultMessage.textContent = `Désolé ${getName}, vous avez perdu! Le nombre était ${nombreAleatoire}. Vous avez utilisé ${time} millisecondes.`;
                    play.style.display = 'none';
                    setPlay.textContent = '';
                    inputPlay.style.display = 'none';
                    replayButton.style.display = 'block';
                    replayButton.addEventListener('click',() => {
                        location.reload();
                    })
                    return;
                }
            }
        })
    }
})


