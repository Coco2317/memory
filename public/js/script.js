// Card game logic
const cards = document.querySelectorAll('.card');
let flippedCards = [];
let matchedPairs = 0;
let attempts = 0;
const totalPairs = cards.length / 2;

// Timer logic
let startTime = Date.now();
let timer = setInterval(updateTimer, 1000);

function updateTimer() {
    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    const timerDisplay = document.getElementById('timer');
    if (timerDisplay) {
        timerDisplay.textContent = `Temps : ${elapsed}s`;
    }
}

// click event for cards
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

// check if all pairs are matched
function checkWin() {
    if (matchedPairs === totalPairs) {
        clearInterval(timer);
        const totalTime = Math.floor((Date.now() - startTime) / 1000);
        const score = Math.max(1000 - (totalTime * 2 + attempts * 10), 0);

        setTimeout(() => {
            showWinMessage(score, totalTime, attempts);
        }, 500);
    }
}



// Display win message
function showWinMessage(score, time, tries) {
    const overlay = document.createElement('div');
    overlay.className = 'win-overlay';
    overlay.innerHTML = `
        <div class="win-box">
            <h2><i class="fa-solid fa-trophy"></i> Bravo !</h2>
            <p>Score : <strong>${score}</strong></p>
            <p><i class="fa-solid fa-stopwatch"></i> Temps : ${time}s</p>
            <p><i class="fa-solid fa-rotate"></i> Tentatives : ${tries}</p>
            <div class="win-buttons">
                <a href="?page=game" class="btn-restart">
                    <i class="fa-solid fa-rotate-right"></i> Rejouer
                </a>
                <a href="?page=score" class="btn-score">
                    <i class="fa-solid fa-ranking-star"></i> Classement
                </a>
                <a href="?page=profile" class="btn-profile">
                    <i class="fa-solid fa-user"></i> Profil joueur
                </a>
            </div>
        </div>
    `;

    // Enregistre le score en base via fetch POST
    fetch('?page=scoreSave', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            username: document.querySelector('header strong').textContent,
            score: score,
            time: time,
            attempts: tries
        })
    });

    document.body.appendChild(overlay);
}

