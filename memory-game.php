<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Memory Card</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo"><i class="fas fa-bolt"></i> XYZ</div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">A Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="jeux.php" class="active">Jeux</a></li>
                </ul>
            </nav>
            <div class="nav-icons">
                <?php if (isset($_SESSION['user_pseudo'])): ?>
                    <div class="user-menu">
                        <span class="user-badge"><i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['user_pseudo']) ?></span>
                        <a href="logout.php" class="logout-link" title="Deconnexion"><i class="fas fa-sign-out-alt"></i></a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="login-link" title="Se connecter"><i class="fas fa-user"></i> Connexion</a>
                <?php endif; ?>
                <a href="admin.php" class="admin-icon" title="Admin"><i class="fas fa-cog"></i></a>
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <div class="promo-marquee">
        <div class="promo-marquee-content">
            <span><i class="fas fa-fire"></i> CODE PROMO : <strong>XYZ15</strong> = -15% sur le produit de votre choix !</span>
            <span><i class="fas fa-gamepad"></i> Jouez a nos mini-jeux et tentez de gagner une PS5 chaque mois !</span>
            <span><i class="fas fa-gift"></i> Roue de la Chance : des produits XYZ a gagner !</span>
            <span><i class="fas fa-truck"></i> Livraison GRATUITE des 50 d'achat !</span>
            <span><i class="fas fa-fire"></i> CODE PROMO : <strong>XYZ15</strong> = -15% sur le produit de votre choix !</span>
            <span><i class="fas fa-gamepad"></i> Jouez a nos mini-jeux et tentez de gagner une PS5 chaque mois !</span>
            <span><i class="fas fa-gift"></i> Roue de la Chance : des produits XYZ a gagner !</span>
            <span><i class="fas fa-truck"></i> Livraison GRATUITE des 50 d'achat !</span>
        </div>
    </div>

    <section class="game-page-hero">
        <a href="jeux.php" class="back-link"><i class="fas fa-arrow-left"></i> Retour aux jeux</a>
        <h1><i class="fas fa-brain"></i> MEMORY CARD</h1>
        <p>Retrouvez les paires de produits XYZ !</p>
    </section>

    <section class="game-container">
        <div class="memory-stats">
            <span><i class="fas fa-mouse-pointer"></i> Coups: <strong id="memory-moves">0</strong></span>
            <span><i class="fas fa-check-circle"></i> Paires: <strong id="memory-pairs">0</strong>/8</span>
            <span><i class="fas fa-clock"></i> Temps: <strong id="memory-timer">0:00</strong></span>
        </div>
        <div class="memory-board" id="memory-board"></div>
        <div class="memory-result hidden" id="memory-result">
            <h2><i class="fas fa-trophy" style="color: gold;"></i> Bravo !</h2>
            <p id="memory-result-text"></p>
            <div class="result-actions">
                <button class="cta-button" onclick="initMemory()"><i class="fas fa-redo"></i> Rejouer</button>
                <a href="jeux.php" class="cta-button secondary">Autres jeux</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section"><h4>XYZ</h4><p>Les meilleurs supplements pre-workout pour vos performances</p></div>
            <div class="footer-section"><h4>LIENS RAPIDES</h4><ul><li><a href="boutique.php">Boutique</a></li><li><a href="presentation.php">A Propos</a></li><li><a href="mentions.php">Mentions legales</a></li></ul></div>
            <div class="footer-section"><h4>CONTACT</h4><ul><li><a href="contact.php">Nous Contacter</a></li><li><i class="fas fa-phone"></i> 01 23 45 67 89</li><li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li></ul></div>
        </div>
        <div class="footer-bottom"><p>&copy; 2026 XYZ - Tous droits reserves</p></div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>

    <script>
    const cardData = [
        { name: 'EXTREME', icon: 'fas fa-fire', color: '#d9042f' },
        { name: 'ENERGY', icon: 'fas fa-bolt', color: '#FFD600' },
        { name: 'CREATINE', icon: 'fas fa-dumbbell', color: '#4CAF50' },
        { name: 'PUMP', icon: 'fas fa-heart', color: '#E91E63' },
        { name: 'FOCUS', icon: 'fas fa-brain', color: '#9C27B0' },
        { name: 'VEGAN', icon: 'fas fa-leaf', color: '#4CAF50' },
        { name: 'BCAA', icon: 'fas fa-capsules', color: '#FF9800' },
        { name: 'OMEGA', icon: 'fas fa-fish', color: '#2196F3' }
    ];

    let cards = [];
    let flipped = [];
    let matched = 0;
    let moves = 0;
    let timerInterval;
    let seconds = 0;
    let gameStarted = false;

    function shuffle(arr) {
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[i], arr[j]] = [arr[j], arr[i]];
        }
        return arr;
    }

    function initMemory() {
        cards = shuffle([...cardData, ...cardData].map((c, i) => ({...c, id: i})));
        flipped = [];
        matched = 0;
        moves = 0;
        seconds = 0;
        gameStarted = false;
        clearInterval(timerInterval);
        document.getElementById('memory-moves').textContent = 0;
        document.getElementById('memory-pairs').textContent = 0;
        document.getElementById('memory-timer').textContent = '0:00';
        document.getElementById('memory-result').classList.add('hidden');

        const board = document.getElementById('memory-board');
        board.innerHTML = '';
        cards.forEach((card, index) => {
            const el = document.createElement('div');
            el.className = 'memory-card';
            el.dataset.index = index;
            el.innerHTML = `
                <div class="memory-card-inner">
                    <div class="memory-card-front">
                        <i class="fas fa-bolt" style="font-size: 2rem; color: var(--primary);"></i>
                    </div>
                    <div class="memory-card-back" style="background: linear-gradient(135deg, ${card.color}22, ${card.color}44);">
                        <i class="${card.icon}" style="font-size: 2rem; color: ${card.color};"></i>
                        <span>${card.name}</span>
                    </div>
                </div>
            `;
            el.addEventListener('click', () => flipCard(index, el));
            board.appendChild(el);
        });
    }

    function flipCard(index, el) {
        if (flipped.length >= 2) return;
        if (el.classList.contains('flipped') || el.classList.contains('matched')) return;

        if (!gameStarted) {
            gameStarted = true;
            timerInterval = setInterval(() => {
                seconds++;
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                document.getElementById('memory-timer').textContent = mins + ':' + (secs < 10 ? '0' : '') + secs;
            }, 1000);
        }

        el.classList.add('flipped');
        flipped.push({index, el, name: cards[index].name});

        if (flipped.length === 2) {
            moves++;
            document.getElementById('memory-moves').textContent = moves;

            if (flipped[0].name === flipped[1].name) {
                flipped[0].el.classList.add('matched');
                flipped[1].el.classList.add('matched');
                matched++;
                document.getElementById('memory-pairs').textContent = matched;
                flipped = [];

                if (matched === cardData.length) {
                    clearInterval(timerInterval);
                    setTimeout(() => {
                        const mins = Math.floor(seconds / 60);
                        const secs = seconds % 60;
                        document.getElementById('memory-result-text').textContent =
                            'Termine en ' + moves + ' coups et ' + mins + ':' + (secs < 10 ? '0' : '') + secs + ' !';
                        document.getElementById('memory-result').classList.remove('hidden');
                    }, 500);
                }
            } else {
                setTimeout(() => {
                    flipped[0].el.classList.remove('flipped');
                    flipped[1].el.classList.remove('flipped');
                    flipped = [];
                }, 800);
            }
        }
    }

    initMemory();

    // Menu burger + cart badge
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('nav-active');
                navToggle.classList.toggle('is-active');
            });
        }
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const cartBadge = document.querySelector('.cart-count-badge');
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        if (cartBadge && totalItems > 0) { cartBadge.textContent = totalItems; cartBadge.style.display = 'flex'; }
    });
    </script>
</body>
</html>
