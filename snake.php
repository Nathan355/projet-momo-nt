<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Snake Game</title>
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
        <h1><i class="fas fa-dragon"></i> SNAKE GAME</h1>
        <p>Utilisez les fleches du clavier ou les boutons pour diriger le serpent !</p>
    </section>

    <section class="game-container">
        <div class="snake-game-wrapper">
            <div class="snake-score-bar">
                <span><i class="fas fa-star"></i> Score: <strong id="snake-score">0</strong></span>
                <span><i class="fas fa-trophy"></i> Record: <strong id="snake-best">0</strong></span>
            </div>
            <canvas id="snake-canvas" width="400" height="400"></canvas>
            <div class="snake-overlay" id="snake-overlay">
                <div class="snake-overlay-content">
                    <h2 id="snake-overlay-title">SNAKE XYZ</h2>
                    <p id="snake-overlay-text">Mangez les proteines pour grandir !</p>
                    <button class="cta-button" id="snake-start-btn"><i class="fas fa-play"></i> Jouer</button>
                </div>
            </div>
            <div class="snake-controls">
                <div class="control-row">
                    <button class="control-btn" id="btn-up"><i class="fas fa-arrow-up"></i></button>
                </div>
                <div class="control-row">
                    <button class="control-btn" id="btn-left"><i class="fas fa-arrow-left"></i></button>
                    <button class="control-btn" id="btn-down"><i class="fas fa-arrow-down"></i></button>
                    <button class="control-btn" id="btn-right"><i class="fas fa-arrow-right"></i></button>
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

    <script>
    const canvas = document.getElementById('snake-canvas');
    const ctx = canvas.getContext('2d');
    const gridSize = 20;
    const tileCount = canvas.width / gridSize;

    let snake = [{x: 10, y: 10}];
    let food = {x: 15, y: 15};
    let dx = 0, dy = 0;
    let score = 0;
    let bestScore = parseInt(localStorage.getItem('snakeBest')) || 0;
    let gameRunning = false;
    let gameLoop;

    document.getElementById('snake-best').textContent = bestScore;

    function drawGame() {
        // Fond
        ctx.fillStyle = '#1a1a1a';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Grille subtile
        ctx.strokeStyle = '#222';
        for (let i = 0; i < tileCount; i++) {
            ctx.beginPath();
            ctx.moveTo(i * gridSize, 0);
            ctx.lineTo(i * gridSize, canvas.height);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(0, i * gridSize);
            ctx.lineTo(canvas.width, i * gridSize);
            ctx.stroke();
        }

        // Nourriture
        ctx.fillStyle = '#d9042f';
        ctx.shadowColor = '#d9042f';
        ctx.shadowBlur = 10;
        ctx.beginPath();
        ctx.arc(food.x * gridSize + gridSize/2, food.y * gridSize + gridSize/2, gridSize/2 - 2, 0, Math.PI * 2);
        ctx.fill();
        ctx.shadowBlur = 0;

        // Serpent
        snake.forEach((segment, index) => {
            if (index === 0) {
                ctx.fillStyle = '#FFD600';
                ctx.shadowColor = '#FFD600';
                ctx.shadowBlur = 8;
            } else {
                ctx.fillStyle = '#d9042f';
                ctx.shadowBlur = 0;
            }
            ctx.fillRect(segment.x * gridSize + 1, segment.y * gridSize + 1, gridSize - 2, gridSize - 2);
            ctx.shadowBlur = 0;
        });
    }

    function moveSnake() {
        const head = {x: snake[0].x + dx, y: snake[0].y + dy};

        // Collision murs
        if (head.x < 0 || head.x >= tileCount || head.y < 0 || head.y >= tileCount) {
            gameOver();
            return;
        }

        // Collision soi-meme
        for (let i = 0; i < snake.length; i++) {
            if (head.x === snake[i].x && head.y === snake[i].y) {
                gameOver();
                return;
            }
        }

        snake.unshift(head);

        // Manger nourriture
        if (head.x === food.x && head.y === food.y) {
            score += 10;
            document.getElementById('snake-score').textContent = score;
            placeFood();
        } else {
            snake.pop();
        }
    }

    function placeFood() {
        food = {
            x: Math.floor(Math.random() * tileCount),
            y: Math.floor(Math.random() * tileCount)
        };
        // Pas sur le serpent
        for (let s of snake) {
            if (food.x === s.x && food.y === s.y) {
                placeFood();
                return;
            }
        }
    }

    function gameOver() {
        gameRunning = false;
        clearInterval(gameLoop);
        if (score > bestScore) {
            bestScore = score;
            localStorage.setItem('snakeBest', bestScore);
            document.getElementById('snake-best').textContent = bestScore;
        }
        const overlay = document.getElementById('snake-overlay');
        document.getElementById('snake-overlay-title').textContent = 'GAME OVER';
        document.getElementById('snake-overlay-text').textContent = 'Score: ' + score + ' | Record: ' + bestScore;
        document.getElementById('snake-start-btn').innerHTML = '<i class="fas fa-redo"></i> Rejouer';
        overlay.style.display = 'flex';
    }

    function startGame() {
        snake = [{x: 10, y: 10}];
        dx = 1; dy = 0;
        score = 0;
        document.getElementById('snake-score').textContent = 0;
        placeFood();
        document.getElementById('snake-overlay').style.display = 'none';
        gameRunning = true;
        gameLoop = setInterval(() => {
            moveSnake();
            drawGame();
        }, 120);
    }

    document.getElementById('snake-start-btn').addEventListener('click', startGame);

    document.addEventListener('keydown', (e) => {
        if (!gameRunning) return;
        switch(e.key) {
            case 'ArrowUp':    if (dy !== 1)  { dx = 0; dy = -1; } break;
            case 'ArrowDown':  if (dy !== -1) { dx = 0; dy = 1; }  break;
            case 'ArrowLeft':  if (dx !== 1)  { dx = -1; dy = 0; } break;
            case 'ArrowRight': if (dx !== -1) { dx = 1; dy = 0; }  break;
        }
        e.preventDefault();
    });

    // Boutons tactiles
    document.getElementById('btn-up').addEventListener('click', () => { if (gameRunning && dy !== 1)  { dx = 0; dy = -1; } });
    document.getElementById('btn-down').addEventListener('click', () => { if (gameRunning && dy !== -1) { dx = 0; dy = 1; } });
    document.getElementById('btn-left').addEventListener('click', () => { if (gameRunning && dx !== 1)  { dx = -1; dy = 0; } });
    document.getElementById('btn-right').addEventListener('click', () => { if (gameRunning && dx !== -1) { dx = 1; dy = 0; } });

    // Initial draw
    drawGame();

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
