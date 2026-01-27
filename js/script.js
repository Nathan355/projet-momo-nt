// Interactions JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire de contact
    const form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche l'envoi par défaut pour validation

            // Récupération des valeurs
            const nom = document.getElementById('nom').value.trim();
            const prenom = document.getElementById('prenom').value.trim();
            const email = document.getElementById('email').value.trim();
            const sujet = document.getElementById('sujet').value;
            const message = document.getElementById('message').value.trim();

            // Validation
            let erreurs = [];

            if (nom === '') {
                erreurs.push('Le nom est requis.');
            }

            if (prenom === '') {
                erreurs.push('Le prénom est requis.');
            }

            if (email === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                erreurs.push('Un email valide est requis.');
            }

            if (sujet === '') {
                erreurs.push('Veuillez choisir un sujet.');
            }

            if (message === '' || message.length < 10) {
                erreurs.push('Le message doit contenir au moins 10 caractères.');
            }

            // Affichage des erreurs ou envoi
            if (erreurs.length > 0) {
                alert('Erreurs :\n' + erreurs.join('\n'));
            } else {
                alert('Formulaire validé ! Envoi en cours...');
                form.submit(); // Envoi réel après validation
            }
        });
    }

    // --- Menu Burger Responsive ---
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
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Fonction pour afficher une notification
    function showToast(message) {
        const toast = document.getElementById('toast-notification');
        if (toast) {
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000); // La notification disparaît après 3 secondes
        }
    }

    // Fonction pour mettre à jour le badge du panier
    function updateCartBadge() {
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        if (cartBadge) {
            if (totalItems > 0) {
                cartBadge.textContent = totalItems;
                cartBadge.style.display = 'flex';
            } else {
                cartBadge.style.display = 'none';
            }
        }
    }

    // Fonction pour ajouter un article au panier
    function addToCart(product) {
        const existingItem = cartItems.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cartItems.push({ ...product, quantity: 1 });
        }
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartBadge();
        showToast(`${product.name} a été ajouté au panier !`);
    }

    // Ajout des écouteurs d'événements sur les boutons "Ajouter au panier"
    addToCartButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const card = event.target.closest('.product-card');
            const productName = card.querySelector('h3').textContent;
            // Gère le cas des produits en promo qui ont une structure de prix différente
            const priceElement = card.querySelector('.price-section .price') || card.querySelector('.product-footer .price');
            const productPriceText = priceElement.textContent.replace('€', '');
            const productPrice = parseFloat(productPriceText);
            const productImage = card.querySelector('.product-image img').src;
            
            // Utiliser le nom comme ID simple pour cet exemple
            const productId = productName.replace(/\s+/g, '-').toLowerCase();

            const product = {
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage
            };
            
            addToCart(product);
        });
    });
    
    // --- Logique spécifique à la page panier (panier.php) ---
    if (document.getElementById('cart-page')) { // S'exécute seulement sur panier.php
        function renderCart() {
            const cartEmptyState = document.getElementById('cart-empty-state');
            const cartFullState = document.getElementById('cart-full-state');
            const continueShoppingLink = document.getElementById('continue-shopping-link-bottom');
            const itemsContainer = document.getElementById('cart-items-container');
            const subtotalEl = document.getElementById('summary-subtotal');
            const shippingEl = document.getElementById('summary-shipping');
            const totalEl = document.getElementById('summary-total');

            if (cartItems.length === 0) {
                if (cartEmptyState) cartEmptyState.style.display = 'block';
                if (cartFullState) cartFullState.style.display = 'none';
                if (continueShoppingLink) continueShoppingLink.style.display = 'none';
                updateCartBadge();
                return;
            }

            if (cartEmptyState) cartEmptyState.style.display = 'none';
            if (cartFullState) cartFullState.style.display = 'grid';
            if (continueShoppingLink) continueShoppingLink.style.display = 'block';

            itemsContainer.innerHTML = '';
            let subtotal = 0;

            cartItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');
                itemElement.innerHTML = `
                    <div class="cart-item-image"><img src="${item.image}" alt="${item.name}"></div>
                    <div class="cart-item-details">
                        <h3>${item.name}</h3>
                        <span class="cart-item-price">${item.price.toFixed(2)}€</span>
                    </div>
                    <div class="cart-item-quantity">
                        <button class="qty-btn minus" data-id="${item.id}"><i class="fas fa-minus"></i></button>
                        <input type="number" value="${item.quantity}" min="1" class="qty-input" readonly>
                        <button class="qty-btn plus" data-id="${item.id}"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="cart-item-total">${itemTotal.toFixed(2)}€</div>
                    <button class="cart-item-remove" data-id="${item.id}"><i class="fas fa-trash"></i></button>
                `;
                itemsContainer.appendChild(itemElement);
            });

            const shippingCost = subtotal >= 50 ? 0 : 5.99;
            const total = subtotal + shippingCost;

            if (subtotalEl) subtotalEl.textContent = subtotal.toFixed(2) + '€';
            if (shippingEl) {
                shippingEl.textContent = shippingCost === 0 ? 'GRATUITE' : shippingCost.toFixed(2) + '€';
                shippingEl.classList.toggle('free-shipping', shippingCost === 0);
            }
            if (totalEl) totalEl.textContent = total.toFixed(2) + '€';
            
            updateCartBadge();
        }

        document.getElementById('cart-items-container').addEventListener('click', (event) => {
            const target = event.target.closest('.qty-btn, .cart-item-remove');
            if (!target) return;

            const itemId = target.dataset.id;
            const item = cartItems.find(i => i.id === itemId);
            if (!item) return;

            if (target.classList.contains('plus')) {
                item.quantity++;
            } else if (target.classList.contains('minus')) {
                item.quantity--;
                if (item && item.quantity > 1) {
                    item.quantity--;
                } else {
                    cartItems = cartItems.filter(i => i.id !== itemId);
                }
            } else if (target.classList.contains('cart-item-remove')) {
                cartItems = cartItems.filter(i => i.id !== itemId);
            }

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            renderCart();
        });

        renderCart(); // Affichage initial du panier
    }
    // Mise à jour initiale du badge au chargement de la page
    updateCartBadge();

    // Animation au défilement
    const animatedElements = document.querySelectorAll('.scroll-animate');

    if (animatedElements.length > 0) {
        // On masque les éléments via JS pour qu'ils restent visibles si JS est désactivé.
        animatedElements.forEach(element => {
            element.classList.add('is-hidden-for-animation');
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    entry.target.classList.remove('is-hidden-for-animation');
                    observer.unobserve(entry.target); // Pour que l'animation ne se joue qu'une fois
                }
            });
        }, {
            threshold: 0.1 // Déclenche quand 10% de l'élément est visible
        });

        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
});