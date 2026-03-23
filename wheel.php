<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Roue de la Chance</title>
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
        <h1><i class="fas fa-circle-notch"></i> ROUE DE LA CHANCE</h1>
        <p>Tournez la roue et tentez de gagner des reductions exclusives !</p>
    </section>

    <section class="game-container">
        <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="login-required-box">
            <i class="fas fa-lock" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h2>Connexion requise</h2>
            <p>Vous devez etre connecte pour tourner la roue et tenter de gagner des produits !</p>
            <div class="result-actions">
                <a href="login.php?redirect=wheel.php" class="cta-button"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                <a href="register.php" class="cta-button secondary"><i class="fas fa-user-plus"></i> Creer un compte</a>
            </div>
        </div>
        <?php else: ?>
        <div class="wheel-wrapper">
            <div class="wheel-pointer"><i class="fas fa-caret-down"></i></div>
            <canvas id="wheel-canvas" width="400" height="400"></canvas>
            <button class="cta-button wheel-spin-btn" id="wheel-spin"><i class="fas fa-sync-alt"></i> TOURNER LA ROUE</button>
        </div>

        <div class="wheel-result hidden" id="wheel-result">
            <div class="wheel-result-content">
                <div id="wheel-result-icon"></div>
                <h2 id="wheel-result-title"></h2>
                <p id="wheel-result-text"></p>
                <div id="wheel-result-code" class="wheel-code"></div>
                <div class="result-actions">
                    <button class="cta-button" id="wheel-replay"><i class="fas fa-redo"></i> Retenter</button>
                    <a href="panier.php" class="cta-button secondary"><i class="fas fa-shopping-cart"></i> Voir mon panier</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
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
    const segments = [
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: '-10%', color: '#d9042f', code: 'XYZ10', type: 'code' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'XYZ\nCREATINE', color: '#4CAF50', code: '', type: 'product', desc: 'Un pot de XYZ CREATINE offert !', productId: 'xyz-creatine', productName: 'XYZ CREATINE', productPrice: 0, productImage: 'images/creatine.png' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: '-15%', color: '#FFD600', code: 'XYZ15', type: 'code' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'XYZ\nENERGY', color: '#2196F3', code: '', type: 'product', desc: 'Un pot de XYZ ENERGY offert !', productId: 'xyz-energy', productName: 'XYZ ENERGY', productPrice: 0, productImage: 'images/energy.png' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'Livraison\nGratuite', color: '#E91E63', code: 'XYZFREE', type: 'code' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'Shaker\nXYZ', color: '#FF9800', code: '', type: 'product', desc: 'Un shaker XYZ offert !', productId: 'shaker-xyz', productName: 'Shaker XYZ', productPrice: 0, productImage: 'images/extreme.png' },
        { text: 'Perdu', color: '#555', code: '', type: 'lose' },
        { text: 'Perdu', color: '#333', code: '', type: 'lose' },
        { text: 'XYZ\nEXTREME', color: '#9C27B0', code: '', type: 'product', desc: 'Un pot de XYZ EXTREME offert !', productId: 'xyz-extreme', productName: 'XYZ EXTREME', productPrice: 0, productImage: 'images/extreme.png' }
    ];

    const canvas = document.getElementById('wheel-canvas');
    const ctx = canvas.getContext('2d');
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = 190;

    let currentAngle = 0;
    let spinning = false;

    function drawWheel() {
        const sliceAngle = (2 * Math.PI) / segments.length;

        segments.forEach((seg, i) => {
            const startAngle = currentAngle + i * sliceAngle;
            const endAngle = startAngle + sliceAngle;

            // Segment
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, endAngle);
            ctx.closePath();
            ctx.fillStyle = seg.color;
            ctx.fill();
            ctx.strokeStyle = '#fff';
            ctx.lineWidth = 2;
            ctx.stroke();

            // Texte
            ctx.save();
            ctx.translate(centerX, centerY);
            ctx.rotate(startAngle + sliceAngle / 2);
            ctx.textAlign = 'right';
            ctx.fillStyle = '#fff';
            ctx.font = 'bold 14px Segoe UI';
            ctx.shadowColor = 'rgba(0,0,0,0.5)';
            ctx.shadowBlur = 3;

            const lines = seg.text.split('\n');
            lines.forEach((line, li) => {
                ctx.fillText(line, radius - 15, 5 + (li - (lines.length - 1) / 2) * 16);
            });

            ctx.shadowBlur = 0;
            ctx.restore();
        });

        // Centre
        ctx.beginPath();
        ctx.arc(centerX, centerY, 25, 0, 2 * Math.PI);
        ctx.fillStyle = '#d9042f';
        ctx.fill();
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 3;
        ctx.stroke();

        ctx.fillStyle = '#fff';
        ctx.font = 'bold 12px Segoe UI';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('XYZ', centerX, centerY);
    }

    function spinWheel() {
        if (spinning) return;
        spinning = true;
        document.getElementById('wheel-spin').disabled = true;
        document.getElementById('wheel-result').classList.add('hidden');

        const totalRotation = Math.random() * 360 + 1800; // Au moins 5 tours
        const duration = 4000;
        const startAngle = currentAngle;
        const startTime = performance.now();

        function animate(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // Easing: deceleration
            const eased = 1 - Math.pow(1 - progress, 3);
            const angleRad = (totalRotation * eased) * Math.PI / 180;

            currentAngle = startAngle + angleRad;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawWheel();

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                spinning = false;
                document.getElementById('wheel-spin').disabled = false;
                showResult();
            }
        }

        requestAnimationFrame(animate);
    }

    function showResult() {
        // Calculer le segment gagnant (le pointer est en haut = -PI/2)
        const sliceAngle = (2 * Math.PI) / segments.length;
        const normalizedAngle = ((2 * Math.PI) - (currentAngle % (2 * Math.PI)) + (2 * Math.PI)) % (2 * Math.PI);
        // Le pointeur est en haut (-90deg = 3*PI/2 depuis l'axe positif X)
        const pointerAngle = (normalizedAngle + 3 * Math.PI / 2) % (2 * Math.PI);
        const winIndex = Math.floor(pointerAngle / sliceAngle) % segments.length;
        const winner = segments[winIndex];

        const resultDiv = document.getElementById('wheel-result');
        const iconDiv = document.getElementById('wheel-result-icon');
        const titleEl = document.getElementById('wheel-result-title');
        const textEl = document.getElementById('wheel-result-text');
        const codeEl = document.getElementById('wheel-result-code');

        if (winner.type === 'code') {
            iconDiv.innerHTML = '<i class="fas fa-ticket-alt" style="font-size: 4rem; color: ' + winner.color + ';"></i>';
            titleEl.textContent = 'Felicitations !';
            titleEl.style.color = winner.color;
            textEl.textContent = 'Vous avez gagne : ' + winner.text.replace('\n', ' ') + ' !';
            codeEl.innerHTML = 'Code promo : <strong>' + winner.code + '</strong>';
            codeEl.style.display = 'block';
        } else if (winner.type === 'product') {
            iconDiv.innerHTML = '<i class="fas fa-gift" style="font-size: 4rem; color: ' + winner.color + ';"></i>';
            titleEl.textContent = 'INCROYABLE !';
            titleEl.style.color = winner.color;
            textEl.textContent = winner.desc;
            codeEl.innerHTML = '<i class="fas fa-shopping-cart"></i> Le produit a ete <strong>ajoute a votre panier</strong> gratuitement !';
            codeEl.style.display = 'block';
            // Ajouter le produit au panier localStorage
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const existing = cartItems.find(item => item.id === winner.productId);
            if (existing) {
                existing.quantity++;
            } else {
                cartItems.push({
                    id: winner.productId,
                    name: winner.productName + ' (OFFERT)',
                    price: winner.productPrice,
                    image: winner.productImage,
                    quantity: 1
                });
            }
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            // Mettre a jour le badge
            const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
            const badge = document.querySelector('.cart-count-badge');
            if (badge && totalItems > 0) { badge.textContent = totalItems; badge.style.display = 'flex'; }
        } else {
            iconDiv.innerHTML = '<i class="fas fa-sad-tear" style="font-size: 4rem; color: #999;"></i>';
            titleEl.textContent = 'Pas de chance !';
            titleEl.style.color = '#999';
            textEl.textContent = 'Retentez votre chance, des produits XYZ sont a gagner !';
            codeEl.style.display = 'none';
        }

        resultDiv.classList.remove('hidden');
    }

    document.getElementById('wheel-spin').addEventListener('click', spinWheel);
    document.getElementById('wheel-replay').addEventListener('click', () => {
        document.getElementById('wheel-result').classList.add('hidden');
        spinWheel();
    });

    drawWheel();

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
