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
                <a href="admin.php" class="admin-icon" title="Admin"><i class="fas fa-cog"></i></a>
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <section class="game-page-hero">
        <a href="jeux.php" class="back-link"><i class="fas fa-arrow-left"></i> Retour aux jeux</a>
        <h1><i class="fas fa-circle-notch"></i> ROUE DE LA CHANCE</h1>
        <p>Tournez la roue et tentez de gagner des reductions exclusives !</p>
    </section>

    <section class="game-container">
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
                    <a href="boutique.php" class="cta-button secondary"><i class="fas fa-shopping-bag"></i> Boutique</a>
                </div>
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
    const segments = [
        { text: '-5%', color: '#d9042f', code: 'XYZ5' },
        { text: 'Perdu', color: '#333', code: '' },
        { text: '-10%', color: '#FFD600', code: 'XYZ10' },
        { text: 'Perdu', color: '#555', code: '' },
        { text: '-15%', color: '#4CAF50', code: 'XYZ15' },
        { text: 'Perdu', color: '#333', code: '' },
        { text: '-20%', color: '#E91E63', code: 'XYZ20' },
        { text: 'Livraison\nGratuite', color: '#2196F3', code: 'XYZFREE' },
        { text: 'Perdu', color: '#555', code: '' },
        { text: '-25%', color: '#9C27B0', code: 'XYZ25' },
        { text: 'Perdu', color: '#333', code: '' },
        { text: 'Shaker\nOffert', color: '#FF9800', code: 'XYZSHAKER' }
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

        if (winner.code) {
            iconDiv.innerHTML = '<i class="fas fa-gift" style="font-size: 4rem; color: ' + winner.color + ';"></i>';
            titleEl.textContent = 'Felicitations !';
            titleEl.style.color = winner.color;
            textEl.textContent = 'Vous avez gagne : ' + winner.text.replace('\n', ' ') + ' !';
            codeEl.innerHTML = 'Code promo : <strong>' + winner.code + '</strong>';
            codeEl.style.display = 'block';
        } else {
            iconDiv.innerHTML = '<i class="fas fa-sad-tear" style="font-size: 4rem; color: #999;"></i>';
            titleEl.textContent = 'Pas de chance !';
            titleEl.style.color = '#999';
            textEl.textContent = 'Retentez votre chance !';
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
