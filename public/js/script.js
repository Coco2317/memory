const cards = document.querySelectorAll('.card');
let flippedCards = [];

cards.forEach(card => {
    card.addEventListener('click', () => {
        if (card.classList.contains('flipped') || flippedCards.length === 2) return;
        card.classList.add('flipped');
        flippedCards.push(card);

        if (flippedCards.length === 2) {
            const [card1, card2] = flippedCards;
            const img1 = card1.querySelector('.card-back img').src;
            const img2 = card2.querySelector('.card-back img').src;

            if (img1 === img2) {
                flippedCards = [];
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
