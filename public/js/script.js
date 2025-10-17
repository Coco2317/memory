// Card game logic
const cards = document.querySelectorAll('.card');
let flippedCards = [];
let matchedPairs = 0;
let attempts = 0;
const totalPairs = cards.length / 2;

// Gestion du clic sur les cartes
cards.forEach(card => {
    card.addEventListener('click', () => {
        // On ignore si déjà retournée ou si 2 cartes sont déjà en jeu
        if (card.classList.contains('flipped') || flippedCards.length === 2) return;

        card.classList.add('flipped');
        flippedCards.push(card);

        if (flippedCards.length === 2) {
            attempts++;

            const [card1, card2] = flippedCards;
            const img1 = card1.querySelector('.card-back img').src;
            const img2 = card2.querySelector('.card-back img').src;

            if (img1 === img2) {
                matchedPairs++;
                flippedCards = [];
                checkWin();
            } else {
                setTimeout(() => {
                    card1.classList.remove('flipped');
                    card2.classList.remove('flipped');
                    flippedCards = [];
                }, 1000);
            }
        }
    });
});

// Vérifie si toutes les paires sont trouvées
function checkWin() {
    if (matchedPairs === totalPairs) {
        setTimeout(() => {
            showWinMessage(attempts);
        }, 500);
    }
}

// Affiche le message de victoire et enregistre le score
function showWinMessage(tries) {
    // Calcul du score basé uniquement sur les tentatives
    const score = Math.max(1000 - (tries * 30), 100);

    // Création de la pop-up de victoire
    const overlay = document.createElement('div');
    overlay.className = 'win-overlay';
    overlay.innerHTML = `
        <div class="win-box">
            <h2><i class="fa-solid fa-trophy"></i> Bravo !</h2>
            <p>Score : <strong>${score}</strong></p>
            <p><i class="fa-solid fa-rotate"></i> Tentatives : ${tries}</p>
            <div class="win-buttons">
                <a href="?page=game&replay=1" class="btn-restart">
            <i class="fa-solid fa-rotate-right"></i> Rejouer
        </a>
                <a href="?page=score" class="btn-score">
                    <i class="fa-solid fa-ranking-star"></i> Classement
                </a>
                <a href="?page=profile" class="btn-profile">
                    <i class="fa-solid fa-user"></i> Mon Profil
                </a>
            </div>
        </div>
    `;

    // Enregistrement du score via fetch POST
    fetch('?page=scoreSave', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            username: document.querySelector('header strong').textContent,
            score: score,
            attempts: tries
        })
    });

    document.body.appendChild(overlay);
}
