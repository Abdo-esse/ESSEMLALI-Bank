<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EssemlaliBank - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-blue-700">EssemlaliBank</a>
            <ul class="hidden md:flex space-x-6">
                <li><a href="#" class="hover:text-blue-600 transition">Accueil</a></li>
                <li><a href="#" class="hover:text-blue-600 transition">Services</a></li>
                <li><a href="#" class="hover:text-blue-600 transition">À propos</a></li>
                <li><a href="#" class="hover:text-blue-600 transition">Contact</a></li>
            </ul>
            <a href="#" class="hidden md:block bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">Se connecter</a>
        </div>
    </nav>

    <!-- Section Hero -->
    <section class="relative bg-blue-700 text-white h-screen flex items-center justify-center text-center">
        <div class="max-w-4xl">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                <span id="typing-text"></span><span class="blink">|</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl opacity-80">Avec EssemlaliBank, profitez d'une plateforme sécurisée et intuitive pour toutes vos transactions.</p>
            <a href="#" class="mt-6 inline-block bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-200 transition">Créer un compte</a>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-24 text-white" viewBox="0 0 1440 320" fill="currentColor">
                <path d="M0,160L60,144C120,128,240,96,360,112C480,128,600,192,720,197.3C840,203,960,149,1080,122.7C1200,96,1320,96,1380,96L1440,96L1440,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Services -->
    <section class="py-16 px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900 opacity-0" id="services-title">Nos Services</h2>
        <p class="text-gray-600 mt-2 opacity-0" id="services-desc">Découvrez les fonctionnalités avancées d'EssemlaliBank</p>
        
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 opacity-0 service-card">
                <h3 class="text-xl font-semibold text-blue-700">Gestion des Comptes</h3>
                <p class="text-gray-600 mt-2">Visualisez et gérez vos finances en un clin d'œil.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 opacity-0 service-card">
                <h3 class="text-xl font-semibold text-blue-700">Transactions Sécurisées</h3>
                <p class="text-gray-600 mt-2">Effectuez vos paiements en toute confiance.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 opacity-0 service-card">
                <h3 class="text-xl font-semibold text-blue-700">Support 24/7</h3>
                <p class="text-gray-600 mt-2">Une assistance disponible à tout moment.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6">
        <p>&copy; 2025 EssemlaliBank. Tous droits réservés.</p>
    </footer>

    <!-- Script d'animation -->
    <script>
        // Animation du texte dynamique
        const textArray = ["Gérez vos finances en toute simplicité", "Votre banque digitale de confiance", "Des transactions rapides et sécurisées"];
        let textIndex = 0;
        let charIndex = 0;
        let typingText = document.getElementById("typing-text");

        function typeText() {
            if (charIndex < textArray[textIndex].length) {
                typingText.innerHTML += textArray[textIndex].charAt(charIndex);
                charIndex++;
                setTimeout(typeText, 100);
            } else {
                setTimeout(eraseText, 2000);
            }
        }

        function eraseText() {
            if (charIndex > 0) {
                typingText.innerHTML = textArray[textIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(eraseText, 50);
            } else {
                textIndex = (textIndex + 1) % textArray.length;
                setTimeout(typeText, 500);
            }
        }

        typeText();

        // Animation GSAP
        gsap.from(".service-card", {
            opacity: 0,
            y: 50,
            stagger: 0.3,
            duration: 1,
            scrollTrigger: {
                trigger: ".service-card",
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });

        gsap.to("#services-title", { opacity: 1, y: 0, duration: 1, delay: 0.2 });
        gsap.to("#services-desc", { opacity: 1, y: 0, duration: 1, delay: 0.5 });

    </script>

</body>
</html>
